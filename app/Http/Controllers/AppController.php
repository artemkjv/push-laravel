<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushAppRequest;
use App\Http\Requests\StoreAppRequest;
use App\Http\Requests\TestPushUserRequest;
use App\Http\Requests\UpdateAppRequest;
use App\Libraries\Decoration\UserInterface;
use App\Models\App;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\Eloquent\AutoPushRepository;
use App\Repositories\Eloquent\CustomPushRepository;
use App\Repositories\Eloquent\WeeklyPushRepository;
use App\Repositories\PlatformRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use App\Services\AppService;

class AppController extends Controller
{

    private PlatformRepositoryInterface $platformRepository;
    private AppRepositoryInterface $appRepository;
    private AutoPushRepository $autoPushRepository;
    private WeeklyPushRepository $weeklyPushRepository;
    private CustomPushRepository $customPushRepository;
    private PushUserRepositoryInterface $pushUserRepository;
    private AppService $appService;

    public function __construct(
        PlatformRepositoryInterface $platformRepository,
        AppRepositoryInterface      $appRepository,
        CustomPushRepository        $customPushRepository,
        AutoPushRepository          $autoPushRepository,
        WeeklyPushRepository        $weeklyPushRepository,
        PushUserRepositoryInterface $pushUserRepository,
        AppService                  $appService,
    )
    {
        $this->platformRepository = $platformRepository;
        $this->appRepository = $appRepository;
        $this->autoPushRepository = $autoPushRepository;
        $this->weeklyPushRepository = $weeklyPushRepository;
        $this->customPushRepository = $customPushRepository;
        $this->pushUserRepository = $pushUserRepository;
        $this->appService = $appService;
    }

    public function index()
    {
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUserPaginated(
            $userDecorator,
            request()->get('limit') ?? App::PAGINATE,
            request()->get('search')
        )->appends(request()->except('page'));
        return view('app.index', compact('apps'));
    }

    public function create()
    {
        return view('app.create');
    }

    public function store(StoreAppRequest $request)
    {
        $this->authorize('create', App::class);
        $validated = $request->validated();
        $path = $this->appService->handleUploadedCertificate($request->file('certificate'), $validated['private_key'] ?? '');
        $validated['web_icon'] = $this->appService->handleWebIcon($request->file('web_icon'));
        $validated['certificate'] = $path;
        $platformId = $validated['platform_id'];
        $app = $this->appRepository->save($validated);
        try {
            if((int) $platformId === 3) {
                $webPath = $this->appService->handleUploadedWebCertificate(
                    $request->file('web_certificate'),
                    $validated['web_private_key'] ?? '',
                    $app
                );
                $app->update([
                    'web_certificate' => $webPath
                ]);
            }
        } catch (\Exception $exception) {
            return redirect()->route('app.edit', ['id' => $app->id])
                ->withErrors([
                    'certificate' => $exception->getMessage()
                ]);
        }
        $app->platforms()->attach([$platformId]);
        return redirect()->route('app.show', ['id' => $app->id]);
    }

    public function edit($id)
    {
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $platforms = $this->platformRepository->getAll();
        return view('app.edit', compact('app', 'platforms'));
    }

    public function show($id)
    {
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $customPushes = $this->customPushRepository->getByUser($userDecorator);
        $weeklyPushes = $this->weeklyPushRepository->getByUser($userDecorator);
        $autoPushes = $this->autoPushRepository->getByUser($userDecorator);
        $chosenCustomPushes = $app->customPushes()->get();
        $chosenAutoPushes = $app->autoPushes()->get();
        $chosenWeeklyPushes = $app->weeklyPushes()->get();
        return view('app.show', compact(
            'app',
            'customPushes',
            'weeklyPushes',
            'autoPushes',
            'chosenCustomPushes',
            'chosenAutoPushes',
            'chosenWeeklyPushes'
        ));
    }

    public function update(UpdateAppRequest $request, $id)
    {
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $validated = $request->validated();
        $path = $this->appService->handleUploadedCertificate($request->file('certificate'), $validated['private_key'] ?? '');
        if (!is_null($path)) {
            $validated['certificate'] = $path;
        }
        try {
            $webPath = $this->appService->handleUploadedWebCertificate($request->file('web_certificate'), $validated['web_private_key'] ?? '', $app);
        } catch (\Exception $exception) {
            return redirect()->back()
                ->withErrors([
                    'certificate' => $exception->getMessage()
                ]);
        }
        if (!is_null($webPath)) {
            $validated['web_certificate'] = $webPath;
        }
        if (in_array(3, $validated['platforms'])) {
            $webIcon = $this->appService->handleWebIcon($request->file('web_icon'));
            if (!is_null($webIcon)) {
                $validated['web_icon'] = $webIcon;
            } elseif (is_null($app->web_icon)) {
                return redirect()->back()
                    ->withErrors(['web_icon' => 'The web icon field is required.']);
            }
        }
        $platforms = $validated['platforms'];
        $app->update($validated);
        $app->platforms()->sync($platforms);
        return redirect()->route('app.index');
    }

    public function destroy($id)
    {
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $app);
        $app->delete();
        return redirect()->back();
    }

    public function push(PushAppRequest $request, $id)
    {
        $payload = $request->validated();
        \DB::transaction(function () use ($id, $payload) {
            $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
            $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
            $customPushes = $app->customPushes()->withCount('apps')->get();
            $weeklyPushes = $app->weeklyPushes()->withCount('apps')->get();
            $autoPushes = $app->autoPushes()->withCount('apps')->get();
            $chosenCustomPushes = $this->customPushRepository->getByUserAndIds($userDecorator, $payload['custom_pushes'] ?? []);
            $chosenAutoPushes = $this->autoPushRepository->getByUserAndIds($userDecorator, $payload['auto_pushes'] ?? []);
            $chosenWeeklyPushes = $this->weeklyPushRepository->getByUserAndIds($userDecorator, $payload['weekly_pushes'] ?? []);
            $this->handleChosenPushes($customPushes, $chosenCustomPushes, $app, 'customPushes');
            $this->handleChosenPushes($autoPushes, $chosenAutoPushes, $app, 'autoPushes');
            $this->handleChosenPushes($weeklyPushes, $chosenWeeklyPushes, $app, 'weeklyPushes');
        });
        return redirect()->route('app.index');
    }

    private function handleChosenPushes($pushes, $chosenPushes, $app, $relationName)
    {
        foreach ($pushes as $push) {
            if (!$chosenPushes->contains('id', $push->id)) {
                if ($push->apps_count <= 1) {
                    $push->status = 'PAUSE';
                    $push->save();
                } else {
                    $push->apps()->detach($app);
                }
            }
        }
        $app->{$relationName}()->syncWithoutDetaching($chosenPushes);
    }

}

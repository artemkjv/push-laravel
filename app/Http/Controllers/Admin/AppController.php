<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppRequest;
use App\Http\Requests\UpdateAppRequest;
use App\Libraries\Decoration\UserWrapper;
use App\Models\App;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\AppService;

class AppController extends Controller
{

    private PlatformRepositoryInterface $platformRepository;
    private AppRepositoryInterface $appRepository;
    private UserRepositoryInterface $userRepository;
    private AppService $appService;

    public function __construct(
        PlatformRepositoryInterface $platformRepository,
        AppRepositoryInterface $appRepository,
        UserRepositoryInterface $userRepository,
        AppService $appService
    )
    {
        $this->platformRepository = $platformRepository;
        $this->appRepository = $appRepository;
        $this->userRepository = $userRepository;
        $this->appService = $appService;
    }

    public function index(){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $apps = $this->appRepository->getByUserPaginated(
            $userDecorator,
            request()->get('limit') ?? App::PAGINATE,
            request()->get('search')
        )->appends(request()->except('page'));
        return view('admin.app.index', compact('apps', 'user'));
    }

    public function create(){
        $user = \request()->currentUser;
        return view('admin.app.create', compact('user'));
    }

    public function store(StoreAppRequest $request){
        $user = \request()->currentUser;
        $validated = $request->validated();
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
        return redirect()->route('admin.app.show', ['userId' => $user->id, 'id' => $app->id]);
    }

    public function edit($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        return view('admin.app.edit', compact('app', 'user'));
    }

    public function show($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        return view('admin.app.show', compact('app', 'user' ));
    }

    public function update(UpdateAppRequest $request, $userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
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
        return redirect()->route('admin.app.index', ['userId' => $userId]);
    }

    public function destroy($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $app);
        $app->delete();
        return redirect()->back();
    }

}

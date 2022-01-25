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

class AppController extends Controller
{

    private PlatformRepositoryInterface $platformRepository;
    private AppRepositoryInterface $appRepository;
    private AutoPushRepository $autoPushRepository;
    private WeeklyPushRepository $weeklyPushRepository;
    private CustomPushRepository $customPushRepository;
    private PushUserRepositoryInterface $pushUserRepository;

    public function __construct(
        PlatformRepositoryInterface $platformRepository,
        AppRepositoryInterface $appRepository,
        CustomPushRepository $customPushRepository,
        AutoPushRepository $autoPushRepository,
        WeeklyPushRepository $weeklyPushRepository,
        PushUserRepositoryInterface $pushUserRepository
    )
    {
        $this->platformRepository = $platformRepository;
        $this->appRepository = $appRepository;
        $this->autoPushRepository = $autoPushRepository;
        $this->weeklyPushRepository = $weeklyPushRepository;
        $this->customPushRepository = $customPushRepository;
        $this->pushUserRepository = $pushUserRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUserPaginated(
            $userDecorator,
            request()->get('limit') ?? App::PAGINATE,
            request()->get('search')
        )->appends(request()->except('page'));
        return view('app.index', compact('apps'));
    }

    public function create(){
        $platforms = $this->platformRepository->getAll();
        return view('app.create', compact('platforms'));
    }

    public function store(StoreAppRequest $request){
        $this->authorize('create', App::class);
        $validated = $request->validated();
        $platform_id = $validated['platform_id'];
        $app = $this->appRepository->save($validated);
        $app->platforms()->attach([$platform_id]);
        return redirect()->route('app.show', ['id' => $app->id]);
    }

    public function edit($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $platforms = $this->platformRepository->getAll();
        return view('app.edit', compact('app', 'platforms'));
    }

    public function show($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $customPushes = $this->customPushRepository->getByUser($userDecorator);
        $weeklyPushes =  $this->weeklyPushRepository->getByUser($userDecorator);
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

    public function testPushUsersRender($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $pushUsers = $this->pushUserRepository->getByApp($app);
        return view('app.test-users', compact(
            'app',
            'pushUsers'
        ));
    }

    public function testPushUsersHandle(TestPushUserRequest $request, $id){
        $payload = $request->validated();
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $this->pushUserRepository->updateByAppWhereTest($app, [
            'is_test' => false
        ]);
        $this->pushUserRepository->updateByIdsAndApp($payload['pushUsers'] ?? [], $app, [
            'is_test' => true
        ]);
        return redirect()->route('app.index');
    }

    public function update(UpdateAppRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $validated = $request->validated();
        $platforms = $validated['platforms'];
        $app->update($validated);
        $app->platforms()->sync($platforms);
        return redirect()->route('app.index');
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $app);
        $app->delete();
        return redirect()->back();
    }

    public function push(PushAppRequest $request, $id){
        $payload = $request->validated();
        \DB::transaction(function () use ($id, $payload) {
            $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
            $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
            $customPushes = $app->customPushes()->get();
            $weeklyPushes = $app->weeklyPushes()->get();
            $autoPushes = $app->autoPushes()->get();
            $chosenCustomPushes = $this->customPushRepository->getByUserAndIds($userDecorator, $payload['custom_pushes'] ?? []);
            $chosenAutoPushes = $this->autoPushRepository->getByUserAndIds($userDecorator, $payload['auto_pushes'] ?? []);
            $chosenWeeklyPushes = $this->weeklyPushRepository->getByUserAndIds($userDecorator, $payload['weekly_pushes'] ?? []);
            $this->handleChosenPushes($customPushes, $chosenCustomPushes, $app, 'customPushes');
            $this->handleChosenPushes($autoPushes, $chosenAutoPushes, $app, 'autoPushes');
            $this->handleChosenPushes($weeklyPushes, $chosenWeeklyPushes, $app, 'weeklyPushes');
        });
        return redirect()->route('app.index');
    }

    private function handleChosenPushes($pushes, $chosenPushes, $app, $relationName){
        foreach ($pushes as $push){
            if(!$chosenPushes->contains('id', $push->id)){
                $push->status = 'PAUSE';
                $push->save();
            }
        }
        foreach ($chosenPushes as $chosenPush){
            $app->{$relationName}()->attach($chosenPush);
        }
    }

}

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

class AppController extends Controller
{

    private PlatformRepositoryInterface $platformRepository;
    private AppRepositoryInterface $appRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        PlatformRepositoryInterface $platformRepository,
        AppRepositoryInterface $appRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->platformRepository = $platformRepository;
        $this->appRepository = $appRepository;
        $this->userRepository = $userRepository;
    }

    public function index(){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $apps = $this->appRepository->getByUserPaginated(
            $userDecorator,
            request()->get('limit') ?? App::PAGINATE,
            request()->get('search')
        );
        return view('admin.app.index', compact('apps', 'user'));
    }

    public function create(){
        $platforms = $this->platformRepository->getAll();
        $user = \request()->currentUser;
        return view('admin.app.create', compact('platforms', 'user'));
    }

    public function store(StoreAppRequest $request){
        $user = \request()->currentUser;
        $validated = $request->validated();
        $platform_id = $validated['platform_id'];
        $app = $this->appRepository->save($validated);
        $app->platforms()->attach([$platform_id]);
        return redirect()->route('admin.app.show', ['userId' => $user->id, 'id' => $app->id]);
    }

    public function edit($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $platforms = $this->platformRepository->getAll();
        return view('admin.app.edit', compact('app', 'platforms', 'user'));
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
        $platforms = $validated['platforms'];
        $app->update($validated);
        $app->platforms()->sync($platforms);
        return redirect()->route('admin.app.index', ['userId' => $userId]);
    }

    public function destroy($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $app->delete();
        return redirect()->back();
    }

}

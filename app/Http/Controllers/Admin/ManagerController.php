<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreManagerRequest;
use App\Http\Requests\UpdateManagerRequest;
use App\Libraries\Decoration\ManagerWrapper;
use App\Libraries\Decoration\UserInterface;
use App\Models\AutoPush;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        $managers = $this->userRepository->getManagersPaginated(
            \request()->get('limit') ?? User::PAGINATE,
            \request()->get('search')
        )->appends(request()->except('page'));
        return view('admin.manager.index', compact('managers'));
    }

    public function create(){
        $userDecorator = App::make(UserInterface::class);
        $users = $this->userRepository->getManagedUsers($userDecorator);
        return view('admin.manager.create', compact('users'));
    }

    public function store(StoreManagerRequest $request){
        $userDecorator = App::make(UserInterface::class);
        $payload = $request->validated();
        $payload['password'] = Hash::make($payload['password']);
        $payload['role'] = config('roles.manager');
        $manager = $this->userRepository->save($payload);
        $managedUsers = $this->userRepository->getManagedUsersByIdsAndUser($payload['users'] ?? [], $userDecorator);
        $managerDecorator = new ManagerWrapper($manager);
        $managerDecorator->managedUsers()->sync($managedUsers);
        return redirect()->route('admin.manager.index');
    }

    public function edit($id){
        $manager = $this->userRepository->getManagerById($id);
        $managerDecorator = new ManagerWrapper($manager);
        $userDecorator = App::make(UserInterface::class);
        $users = $this->userRepository->getManagedUsers($userDecorator);
        return view('admin.manager.edit', compact('manager', 'users', 'managerDecorator'));
    }

    public function update(UpdateManagerRequest $request, $id){
        $userDecorator = App::make(UserInterface::class);
        $payload = $request->validated();
        $manager = $this->userRepository
            ->getManagerById($id)
            ->toArray();
        $manager = $this->userRepository->save(array_merge($manager, $payload));
        $managerDecorator = new ManagerWrapper($manager);
        $users = $this->userRepository->getManagedUsersByIdsAndUser($payload['users'] ?? [], $userDecorator);
        $managerDecorator->managedUsers()->sync($users);
        return redirect()->route('admin.manager.index');
    }

    public function destroy($id){
        $manager = $this->userRepository->getManagerById($id);
        $manager->delete();
        return redirect()->back();
    }

}

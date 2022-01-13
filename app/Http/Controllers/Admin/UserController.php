<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Decoration\UserInterface;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $users = $this->userRepository->getManagedUsersByUserPaginated($userDecorator, \App\Models\User::PAGINATE);
        return view('admin.user.index', compact('users'));
    }

    public function show($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $user = $this->userRepository->getManagedUserByIdAndUser($id, $userDecorator);
        return view('admin.user.show', compact('user'));
    }

}

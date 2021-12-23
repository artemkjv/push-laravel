<?php

namespace App\Http\Controllers;

use App\Libraries\Decoration\UserInterface;
use App\Models\PushUser;
use App\Repositories\PushUserRepositoryInterface;
use Illuminate\Http\Request;

class PushUserController extends Controller
{

    private PushUserRepositoryInterface $pushUserRepository;

    public function __construct(
        PushUserRepositoryInterface $pushUserRepository
    )
    {
        $this->pushUserRepository = $pushUserRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $pushUsers = $this->pushUserRepository->getByUserPaginated($userDecorator, PushUser::PAGINATE);
        return view('pushUser.index', compact('pushUsers'));
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $pushUser = $this->pushUserRepository->getByIdAndUser($id, $userDecorator);
        $pushUser->delete();
        return redirect()->back();
    }

}

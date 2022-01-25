<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Decoration\UserInterface;
use App\Libraries\Decoration\UserWrapper;
use App\Models\SentPush;
use App\Repositories\SentPushRepositoryInterface;
use Illuminate\Http\Request;

class SentPushController extends Controller
{

    private SentPushRepositoryInterface $sentPushRepository;

    public function __construct(
        SentPushRepositoryInterface $sentPushRepository
    )
    {
        $this->sentPushRepository = $sentPushRepository;
    }

    public function index(Request $request){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $sentPushes = $this->sentPushRepository->getByUserPaginated($userDecorator, SentPush::PAGINATE, $request->get('pushable_type'));
        return view('admin.sentPush.index', compact('sentPushes', 'user'));
    }

    public function show($id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $sentPush = $this->sentPushRepository->getByIdAndUser($id, $userDecorator);
        return view('admin.sentPush.show', compact('sentPush', 'user'));
    }

    public function destroy($suerId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $sentPush = $this->sentPushRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $sentPush);
        $sentPush->delete();
        return redirect()->back();
    }

}

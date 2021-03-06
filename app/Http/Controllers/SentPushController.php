<?php

namespace App\Http\Controllers;

use App\Libraries\Decoration\UserInterface;
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
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $sentPushes = $this->sentPushRepository->getByUserPaginated($userDecorator, SentPush::PAGINATE, $request->get('pushable_type'))->appends(request()->except('page'));
        return view('sentPush.index', compact('sentPushes'));
    }

    public function show($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $sentPush = $this->sentPushRepository->getByIdAndUser($id, $userDecorator);
        return view('sentPush.show', compact('sentPush'));
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $sentPush = $this->sentPushRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $sentPush);
        $sentPush->delete();
        return redirect()->back();
    }

}

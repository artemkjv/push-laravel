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

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $sentPushes = $this->sentPushRepository->getByUserPaginated($userDecorator, SentPush::PAGINATE);
        return view('sentPush.index', compact('sentPushes'));
    }

}

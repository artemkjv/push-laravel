<?php

namespace App\Http\Controllers;

use App\Libraries\Decoration\UserInterface;
use App\Models\AutoPush;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\AutoPushRepositoryInterface;
use App\Repositories\Eloquent\TemplateRepository;
use App\Repositories\SegmentRepositoryInterface;
use Illuminate\Http\Request;

class AutoPushController extends Controller
{

    private AutoPushRepositoryInterface $autoPushRepository;
    private AppRepositoryInterface $appRepository;
    private SegmentRepositoryInterface $segmentRepository;
    private TemplateRepository $templateRepository;

    public function __construct(
        AutoPushRepositoryInterface $autoPushRepository,
        AppRepositoryInterface $appRepository,
        SegmentRepositoryInterface $segmentRepository,
        TemplateRepository $templateRepository
    )
    {
        $this->autoPushRepository = $autoPushRepository;
        $this->appRepository = $appRepository;
        $this->segmentRepository = $segmentRepository;
        $this->templateRepository = $templateRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $autoPushes = $this->autoPushRepository->getByUserPaginated($userDecorator, AutoPush::PAGINATE);
        return view('autoPush.index', compact('autoPushes'));
    }

    public function create(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        return view('autoPush.create', compact('apps', 'segments', 'templates'));
    }

}

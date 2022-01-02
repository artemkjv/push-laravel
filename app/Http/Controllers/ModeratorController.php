<?php

namespace App\Http\Controllers;

use App\Libraries\Decoration\UserInterface;
use App\Models\User;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\AutoPushRepositoryInterface;
use App\Repositories\CustomPushRepositoryInterface;
use App\Repositories\ModeratorRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use App\Repositories\TemplateRepositoryInterface;
use App\Repositories\WeeklyPushRepositoryInterface;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{


    private ModeratorRepositoryInterface $moderatorRepository;
    private AppRepositoryInterface $appRepository;
    private SegmentRepositoryInterface $segmentRepository;
    private TemplateRepositoryInterface $templateRepository;
    private CustomPushRepositoryInterface $customPushRepository;
    private AutoPushRepositoryInterface $autoPushRepository;
    private WeeklyPushRepositoryInterface $weeklyPushRepository;

    public function __construct(
        ModeratorRepositoryInterface $moderatorRepository,
        AppRepositoryInterface $appRepository,
        SegmentRepositoryInterface $segmentRepository,
        TemplateRepositoryInterface $templateRepository,
        CustomPushRepositoryInterface $customPushRepository,
        AutoPushRepositoryInterface $autoPushRepository,
        WeeklyPushRepositoryInterface $weeklyPushRepository
    )
    {
        $this->moderatorRepository = $moderatorRepository;
        $this->appRepository = $appRepository;
        $this->segmentRepository = $segmentRepository;
        $this->templateRepository = $templateRepository;
        $this->customPushRepository = $customPushRepository;
        $this->autoPushRepository = $autoPushRepository;
        $this->weeklyPushRepository = $weeklyPushRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $moderators = $this->moderatorRepository->getByUserPaginated($userDecorator, User::PAGINATE);
        return view('moderator.index', compact('moderators'));
    }

    public function create(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        $customPushes = $this->customPushRepository->getByUser($userDecorator);
        $weeklyPushes = $this->weeklyPushRepository->getByUser($userDecorator);
        $autoPushes = $this->autoPushRepository->getByUser($userDecorator);
        return view('moderator.create', compact(
            'apps',
            'segments',
            'templates',
            'customPushes',
            'weeklyPushes',
            'autoPushes'
        ));
    }

}

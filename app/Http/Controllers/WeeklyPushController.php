<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeeklyPushRequest;
use App\Libraries\Decoration\UserInterface;
use App\Models\WeeklyPush;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use App\Repositories\TemplateRepositoryInterface;
use App\Repositories\WeeklyPushRepositoryInterface;
use Illuminate\Http\Request;

class WeeklyPushController extends Controller
{

    private WeeklyPushRepositoryInterface $weeklyPushRepository;
    private AppRepositoryInterface $appRepository;
    private SegmentRepositoryInterface $segmentRepository;
    private TemplateRepositoryInterface $templateRepository;

    public function __construct(
        WeeklyPushRepositoryInterface $weeklyPushRepository,
        AppRepositoryInterface $appRepository,
        SegmentRepositoryInterface $segmentRepository,
        TemplateRepositoryInterface $templateRepository
    )
    {
        $this->weeklyPushRepository = $weeklyPushRepository;
        $this->appRepository = $appRepository;
        $this->segmentRepository = $segmentRepository;
        $this->templateRepository = $templateRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $weeklyPushes = $this->weeklyPushRepository->getByUserPaginated($userDecorator, WeeklyPush::PAGINATE);
        return view('weeklyPush.index', compact('weeklyPushes'));
    }

    public function create(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        return view('weeklyPush.create', compact('apps', 'segments', 'templates'));
    }

    public function store(StoreWeeklyPushRequest $request){
        $payload = $request->validated();
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $appIds = $payload['apps'];
        $segmentIds = $payload['segments'];
        $weeklyPush = $this->weeklyPushRepository->save($payload);
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
        $weeklyPush->apps()->sync($apps);
        $weeklyPush->segments()->sync($segments);
        return redirect()->route('weeklyPush.index');
    }

}

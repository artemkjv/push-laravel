<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeeklyPushRequest;
use App\Http\Requests\UpdateWeeklyPushRequest;
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
        $weeklyPushes = $this->weeklyPushRepository->getByUserPaginated(
            $userDecorator,
            \request()->get('limit') ?? WeeklyPush::PAGINATE,
            \request()->get('search')
        )->appends(request()->except('page'));
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
        $this->authorize('create', WeeklyPush::class);
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

    public function edit($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $weeklyPush = $this->weeklyPushRepository->getByIdAndUser($id, $userDecorator);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        return view('weeklyPush.edit', compact('weeklyPush', 'apps', 'segments', 'templates'));
    }

    public function update(UpdateWeeklyPushRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $weeklyPush = $this->weeklyPushRepository
            ->getByIdAndUser($id, $userDecorator)
            ->toArray();
        $payload = $request->validated();
        $appIds = $payload['apps'];
        $segmentIds = $payload['segments'];
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
        $weeklyPush = $this->weeklyPushRepository->save(array_merge($weeklyPush, $payload));
        $weeklyPush->apps()->sync($apps);
        $weeklyPush->segments()->sync($segments);
        return redirect()->route('weeklyPush.index');
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $weeklyPush = $this->weeklyPushRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $weeklyPush);
        $weeklyPush->delete();
        return redirect()->back();
    }

    public function copy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $weeklyPush = $this->weeklyPushRepository->getByIdAndUser($id, $userDecorator);
        $weeklyPush->copy();
        return redirect()->back();
    }

}

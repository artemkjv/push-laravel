<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreWeeklyPushRequest;
use App\Http\Requests\Api\UpdateWeeklyPushRequest;
use App\Http\Resources\WeeklyPushResource;
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
        return new WeeklyPushResource($weeklyPush);
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
        return new WeeklyPushResource($weeklyPush);
    }

}

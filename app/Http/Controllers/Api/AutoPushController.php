<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAutoPushRequest;
use App\Http\Requests\Api\UpdateAutoPushRequest;
use App\Http\Resources\AutoPushResource;
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
        TemplateRepository $templateRepository,
    )
    {
        $this->autoPushRepository = $autoPushRepository;
        $this->appRepository = $appRepository;
        $this->segmentRepository = $segmentRepository;
        $this->templateRepository = $templateRepository;
    }

    public function store(StoreAutoPushRequest $request){
        $this->authorize('create', AutoPush::class);
        $payload = $request->validated();
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $appIds = $payload['apps'];
        $segmentIds = $payload['segments'];
        $autoPush = $this->autoPushRepository->save($payload);
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
        $autoPush->apps()->sync($apps);
        $autoPush->segments()->sync($segments);
        return new AutoPushResource($autoPush);
    }

    public function update(UpdateAutoPushRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $autoPush = $this->autoPushRepository
            ->getByIdAndUser($id, $userDecorator)
            ->toArray();
        $payload = $request->validated();
        $appIds = $payload['apps'];
        $segmentIds = $payload['segments'];
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
        $autoPush = $this->autoPushRepository->save(array_merge($autoPush, $payload));
        $autoPush->apps()->sync($apps);
        $autoPush->segments()->sync($segments);
        return new AutoPushResource($autoPush);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCustomPushRequest;
use App\Http\Requests\Api\UpdateCustomPushRequest;
use App\Http\Resources\CustomPushResource;
use App\Libraries\Decoration\UserInterface;
use App\Models\CustomPush;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\CustomPushRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use App\Services\CustomPushService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomPushController extends Controller
{

    private CustomPushRepositoryInterface $customPushRepository;
    private SegmentRepositoryInterface $segmentRepository;
    private AppRepositoryInterface $appRepository;
    private CustomPushService $customPushService;

    public function __construct(
        CustomPushRepositoryInterface $customPushRepository,
        SegmentRepositoryInterface $segmentRepository,
        AppRepositoryInterface $appRepository,
        CustomPushService $customPushService
    )
    {
        $this->middleware(['throttle:240,1']);
        $this->customPushRepository = $customPushRepository;
        $this->segmentRepository = $segmentRepository;
        $this->appRepository = $appRepository;
        $this->customPushService = $customPushService;
    }

    public function store(StoreCustomPushRequest $request){
        $this->authorize('create', CustomPush::class);
        DB::transaction(function () use($request) {
            $payload = $request->validated();
            $this->customPushService->handleIsTest($payload);
            $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
            $appIds = $payload['apps'];
            $segmentIds = $payload['segments'];
            if($request->file('image')){
                $payload['image'] = $request->file('image')->store('images', 'public');
            }
            if($request->file('icon')){
                $payload['icon'] = $request->file('icon')->store('icons', 'public');
            }
            $customPush = $this->customPushRepository->save($payload);
            $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
            $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
            $customPush->apps()->sync($apps);
            $customPush->segments()->sync($segments);
            return new CustomPushResource($customPush);
        });
    }

    public function update(UpdateCustomPushRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        DB::transaction(function () use($request, $userDecorator, $id) {
            $customPush = $this->customPushRepository
                ->getByIdAndUser($id, $userDecorator)
                ->toArray();
            $payload = $request->validated();
            $this->customPushService->handleIsTest($payload);
            $appIds = $payload['apps'];
            $segmentIds = $payload['segments'];
            if ($payload['template-image'] || $request->hasFile('image')) {
                $payload['image'] = $this->customPushService->handleUploadedImage($request->file('image'));
            }
            if ($payload['template-icon'] || $request->hasFile('icon')) {
                $payload['icon'] = $this->customPushService->handleUploadedIcon($request->file('icon'));
            }
            $customPush = $this->customPushRepository->save(array_merge($customPush, $payload));
            $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
            $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
            $customPush->apps()->sync($apps);
            $customPush->segments()->sync($segments);
            return new CustomPushResource($customPush);
        });
    }

}

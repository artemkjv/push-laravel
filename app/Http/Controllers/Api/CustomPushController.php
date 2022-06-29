<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ExcelCustomPushRequest;
use App\Http\Requests\Api\StoreCustomPushRequest;
use App\Http\Requests\Api\UpdateCustomPushRequest;
use App\Http\Resources\CustomPushResource;
use App\Jobs\SegmentPushUserJob;
use App\Libraries\Decoration\UserInterface;
use App\Libraries\Helpers\ImageHelper;
use App\Models\CustomPush;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\CustomPushRepositoryInterface;
use App\Repositories\FilterRepositoryInterface;
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
    private ImageHelper $imageHelper;
    private FilterRepositoryInterface $filterRepository;

    private const FILTER_TYPE_TAG = 7;
    private const FILTER_TYPE_COUNTRY = 5;
    private const PREDICATE = 1;

    public function __construct(
        CustomPushRepositoryInterface $customPushRepository,
        SegmentRepositoryInterface $segmentRepository,
        AppRepositoryInterface $appRepository,
        CustomPushService $customPushService,
        FilterRepositoryInterface $filterRepository,
    )
    {
        $this->middleware(['throttle:240,1']);
        $this->customPushRepository = $customPushRepository;
        $this->segmentRepository = $segmentRepository;
        $this->appRepository = $appRepository;
        $this->customPushService = $customPushService;
        $this->filterRepository =$filterRepository;
        $this->imageHelper = ImageHelper::instance();
    }

    public function store(StoreCustomPushRequest $request){
        $this->authorize('create', CustomPush::class);
        $customPush = DB::transaction(function () use($request) {
            $payload = $request->validated();
            $this->customPushService->handleIsTest($payload);
            $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
            $appIds = $payload['apps'];
            $segmentIds = $payload['segments'];
            $this->handleImages($payload);
            $customPush = $this->customPushRepository->save($payload);
            $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
            $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
            $customPush->apps()->sync($apps);
            $customPush->segments()->sync($segments);
            return $customPush;
        });
        return new CustomPushResource($customPush);
    }

    public function excel(ExcelCustomPushRequest $request) {
        $this->authorize('create', CustomPush::class);
        $customPush = DB::transaction(function () use($request) {
            $payload = $request->validated();
            $this->customPushService->handleIsTest($payload);
            $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
            $appIds = $payload['apps'];

            //Creating image and icon if payload data is not empty
            $this->handleImages($payload);

            $customPush = $this->customPushRepository->save($payload);

            // Creating segment if user indicated country_id or tag
            if((isset($payload['tag_key']) && isset($payload['tag_value'])) || isset($payload['country_id'])) {
                $segment = $this->segmentRepository->save([
                    'user_id' => \request()->user()->id,
                    'name' => "Excelsior segment for Custom Push #{$customPush->id}",
                ]);

                if(isset($payload['tag_key']) && isset($payload['tag_value'])) {
                    $this->filterRepository->save([
                        'tag_key' => $payload['tag_key'],
                        'value' => $payload['tag_value'],
                        'segment_id' => $segment->id,
                        'predicate_id' => self::PREDICATE,
                        'filter_type_id' => self::FILTER_TYPE_TAG,
                    ]);
                }

                if(isset($payload['country_id'])) {
                    $this->filterRepository->save([
                        'value' => $payload['country_id'],
                        'segment_id' => $segment->id,
                        'predicate_id' => self::PREDICATE,
                        'filter_type_id' => self::FILTER_TYPE_COUNTRY
                    ]);
                }
                SegmentPushUserJob::dispatch($segment);
            }
            $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
            $customPush->apps()->sync($apps);
            if(isset($segment)) {
                $customPush->segments()->attach($segment);
            }
            return $customPush;
        });
        return new CustomPushResource($customPush);
    }

    private function handleImages(&$payload) {
        if(isset($payload['image'])){
            $path = $this->imageHelper->saveBase64Image($payload['image'], 'images');
            $payload['image'] = $path;
        }

        if(isset($payload['icon'])){
            $path = $this->imageHelper->saveBase64Image($payload['icon'], 'icons');
            $payload['icon'] = $path;
        }
    }

    public function update(UpdateCustomPushRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $customPush = DB::transaction(function () use($request, $userDecorator, $id) {
            $customPush = $this->customPushRepository
                ->getByIdAndUser($id, $userDecorator)
                ->toArray();
            $payload = $request->validated();
            $this->customPushService->handleIsTest($payload);
            $appIds = $payload['apps'];
            $segmentIds = $payload['segments'];
            if ($payload['template-image'] || isset($payload['image'])) {
                $path = $this->imageHelper->saveBase64Image($payload['image'], 'images');
                $payload['image'] = $path;
            }
            if ($payload['template-icon'] || isset($payload['icon'])) {
                $path = $this->imageHelper->saveBase64Image($payload['icon'], 'icons');
                $payload['icon'] = $path;
            }
            $customPush = $this->customPushRepository->save(array_merge($customPush, $payload));
            $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
            $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
            $customPush->apps()->sync($apps);
            $customPush->segments()->sync($segments);
            return $customPush;
        });
        return new CustomPushResource($customPush);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomPushRequest;
use App\Libraries\Decoration\UserInterface;
use App\Models\CustomPush;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\CustomPushRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomPushController extends Controller
{

    private CustomPushRepositoryInterface $customPushRepository;
    private SegmentRepositoryInterface $segmentRepository;
    private AppRepositoryInterface $appRepository;

    public function __construct(
        CustomPushRepositoryInterface $customPushRepository,
        SegmentRepositoryInterface $segmentRepository,
        AppRepositoryInterface $appRepository
    )
    {
        $this->customPushRepository = $customPushRepository;
        $this->segmentRepository = $segmentRepository;
        $this->appRepository = $appRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $customPushes = $this->customPushRepository->getByUserPaginated($userDecorator, CustomPush::PAGINATE);
        return view('customPush.index', compact('customPushes'));
    }

    public function create(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        return view('customPush.create', compact('apps', 'segments'));
    }

    public function store(StoreCustomPushRequest $request){
        DB::transaction(function () use($request) {
            $payload = $request->validated();
            $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
            $appIds = $request->input('apps');
            $segmentIds = $request->input('segments');
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

        });
        return redirect()->route('customPush.index');
    }

}

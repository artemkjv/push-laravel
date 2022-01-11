<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomPushRequest;
use App\Http\Requests\UpdateCustomPushRequest;
use App\Libraries\Decoration\UserInterface;
use App\Models\CustomPush;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\CustomPushRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
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
        $customPushes = $this->customPushRepository->getByUserPaginated(
            $userDecorator,
            request()->get('limit') ?? CustomPush::PAGINATE,
            request()->get('search')
        );
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

        });
        return redirect()->route('customPush.index');
    }

    public function edit($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $customPush = $this->customPushRepository->getByIdAndUser($id, $userDecorator);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        return view( 'customPush.edit', compact('customPush', 'apps', 'segments'));
    }

    public function update(UpdateCustomPushRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $customPush = $this->customPushRepository
            ->getByIdAndUser($id, $userDecorator)
            ->toArray();
        $payload = $request->validated();
        $appIds = $payload['apps'];
        $segmentIds = $payload['segments'];
        if($payload['template-image']){
            $template['image'] = null;
        }
        if($payload['template-icon']){
            $template['icon'] = null;
        }
        if($request->file('image')){
            $payload['image'] = $request->file('image')->store('images', 'public');
        }
        if($request->file('icon')){
            $payload['icon'] = $request->file('icon')->store('icons', 'public');
        }
        $customPush = $this->customPushRepository->save(array_merge($customPush, $payload));
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
        $customPush->apps()->sync($apps);
        $customPush->segments()->sync($segments);
        return redirect()->route('customPush.index');
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $customPush = $this->customPushRepository->getByIdAndUser($id, $userDecorator);
        $customPush->delete();
        return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomPushRequest;
use App\Http\Requests\UpdateCustomPushRequest;
use App\Libraries\Decoration\UserInterface;
use App\Libraries\Decoration\UserWrapper;
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
        $this->customPushRepository = $customPushRepository;
        $this->segmentRepository = $segmentRepository;
        $this->appRepository = $appRepository;
        $this->customPushService = $customPushService;
    }

    public function index(){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $customPushes = $this->customPushRepository->getByUserPaginated(
            $userDecorator,
            request()->get('limit') ?? CustomPush::PAGINATE,
            request()->get('search')
        );
        return view('admin.customPush.index', compact('customPushes', 'user'));
    }

    public function create(){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        return view('admin.customPush.create', compact('apps', 'segments', 'user'));
    }

    public function store(StoreCustomPushRequest $request){
        $user = \request()->currentUser;
        DB::transaction(function () use($request, $user) {
            $payload = $request->validated();
            $userDecorator = new UserWrapper($user);
            $appIds = $payload['apps'];
            $segmentIds = $payload['segments'];
            $payload['image'] = $this->customPushService->handleUploadedImage($request->file('image'));
            $payload['icon'] = $this->customPushService->handleUploadedIcon($request->file('icon'));
            $customPush = $this->customPushRepository->save($payload);
            $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
            $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
            $customPush->apps()->sync($apps);
            $customPush->segments()->sync($segments);

        });
        return redirect()->route('admin.customPush.index', ['userId' => $user->id]);
    }

    public function edit($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $customPush = $this->customPushRepository->getByIdAndUser($id, $userDecorator);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        return view( 'admin.customPush.edit', compact('customPush', 'apps', 'segments', 'user'));
    }

    public function update(UpdateCustomPushRequest $request, $userId, $id){
        $user = \request()->currentUser;
        DB::transaction(function () use($request, $user, $id) {
            $userDecorator = new UserWrapper($user);
            $customPush = $this->customPushRepository
                ->getByIdAndUser($id, $userDecorator)
                ->toArray();
            $payload = $request->validated();
            $appIds = $payload['apps'];
            $segmentIds = $payload['segments'];
            if ($payload['template-image']) {
                $template['image'] = $this->customPushService->handleUploadedImage($request->file('image'));
            }
            if ($payload['template-icon']) {
                $template['icon'] = $this->customPushService->handleUploadedIcon($request->file('icon'));
            }
            $customPush = $this->customPushRepository->save(array_merge($customPush, $payload));
            $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
            $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
            $customPush->apps()->sync($apps);
            $customPush->segments()->sync($segments);
        });
        return redirect()->route('admin.customPush.index', ['userId' => $userId]);
    }

    public function destroy($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $customPush = $this->customPushRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $customPush);
        $customPush->delete();
        return redirect()->back();
    }
}

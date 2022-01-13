<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAutoPushRequest;
use App\Http\Requests\UpdateAutoPushRequest;
use App\Libraries\Decoration\UserInterface;
use App\Libraries\Decoration\UserWrapper;
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

    public function index(){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $autoPushes = $this->autoPushRepository->getByUserPaginated(
            $userDecorator,
            \request()->get('limit') ?? AutoPush::PAGINATE,
            \request()->get('search')
        );
        return view('admin.autoPush.index', compact('autoPushes', 'user'));
    }

    public function create(){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        return view('admin.autoPush.create', compact('apps', 'segments', 'templates', 'user'));
    }

    public function store(StoreAutoPushRequest $request){
        $payload = $request->validated();
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $appIds = $payload['apps'];
        $segmentIds = $payload['segments'];
        $autoPush = $this->autoPushRepository->save($payload);
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
        $autoPush->apps()->sync($apps);
        $autoPush->segments()->sync($segments);
        return redirect()->route('admin.autoPush.index', ['userId' => $user->id]);
    }

    public function edit($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $autoPush = $this->autoPushRepository->getByIdAndUser($id, $userDecorator);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        return view('admin.autoPush.edit', compact('autoPush', 'apps', 'segments', 'templates', 'user'));
    }

    public function update(UpdateAutoPushRequest $request, $userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
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
        return redirect()->route('admin.autoPush.index', ['userId' => $user->id]);
    }

    public function destroy($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $autoPush = $this->autoPushRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $autoPush);
        $autoPush->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWeeklyPushRequest;
use App\Http\Requests\UpdateWeeklyPushRequest;
use App\Libraries\Decoration\UserInterface;
use App\Libraries\Decoration\UserWrapper;
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
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $weeklyPushes = $this->weeklyPushRepository->getByUserPaginated(
            $userDecorator,
            \request()->get('limit') ?? WeeklyPush::PAGINATE,
            \request()->get('search')
        );
        return view('admin.weeklyPush.index', compact('weeklyPushes', 'user'));
    }

    public function create(){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        return view('admin.weeklyPush.create', compact('apps', 'segments', 'templates', 'user'));
    }

    public function store(StoreWeeklyPushRequest $request){
        $payload = $request->validated();
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $appIds = $payload['apps'];
        $segmentIds = $payload['segments'];
        $weeklyPush = $this->weeklyPushRepository->save($payload);
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
        $weeklyPush->apps()->sync($apps);
        $weeklyPush->segments()->sync($segments);
        return redirect()->route('admin.weeklyPush.index', ['userId' => $user->id]);
    }

    public function edit($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $weeklyPush = $this->weeklyPushRepository->getByIdAndUser($id, $userDecorator);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        return view('admin.weeklyPush.edit', compact('weeklyPush', 'apps', 'segments', 'templates', 'user'));
    }

    public function update(UpdateWeeklyPushRequest $request, $userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
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
        return redirect()->route('admin.weeklyPush.index', ['userId' => $user->id]);
    }

    public function destroy($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $weeklyPush = $this->weeklyPushRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $weeklyPush);
        $weeklyPush->delete();
        return redirect()->back();
    }

}

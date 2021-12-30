<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAutoPushRequest;
use App\Http\Requests\UpdateAutoPushRequest;
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
        TemplateRepository $templateRepository
    )
    {
        $this->autoPushRepository = $autoPushRepository;
        $this->appRepository = $appRepository;
        $this->segmentRepository = $segmentRepository;
        $this->templateRepository = $templateRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $autoPushes = $this->autoPushRepository->getByUserPaginated($userDecorator, AutoPush::PAGINATE);
        return view('autoPush.index', compact('autoPushes'));
    }

    public function create(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        return view('autoPush.create', compact('apps', 'segments', 'templates'));
    }

    public function store(StoreAutoPushRequest $request){
        $payload = $request->validated();
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $appIds = $payload['apps'];
        $segmentIds = $payload['segments'];
        $autoPush = $this->autoPushRepository->save($payload);
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $appIds);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $segmentIds);
        $autoPush->apps()->sync($apps);
        $autoPush->segments()->sync($segments);
        return redirect()->route('autoPush.index');
    }

    public function edit($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $autoPush = $this->autoPushRepository->getByIdAndUser($id, $userDecorator);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        return view('autoPush.edit', compact('autoPush', 'apps', 'segments', 'templates'));
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
        return redirect()->route('autoPush.index');
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $autoPush = $this->autoPushRepository->getByIdAndUser($id, $userDecorator);
        $autoPush->delete();
        return redirect()->back();
    }

}

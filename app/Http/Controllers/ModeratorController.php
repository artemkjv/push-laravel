<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModeratorRequest;
use App\Libraries\Decoration\ModeratorWrapper;
use App\Libraries\Decoration\UserInterface;
use App\Models\User;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\AutoPushRepositoryInterface;
use App\Repositories\CustomPushRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use App\Repositories\TemplateRepositoryInterface;
use App\Repositories\WeeklyPushRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ModeratorController extends Controller
{


    private UserRepositoryInterface $userRepository;
    private AppRepositoryInterface $appRepository;
    private SegmentRepositoryInterface $segmentRepository;
    private TemplateRepositoryInterface $templateRepository;
    private CustomPushRepositoryInterface $customPushRepository;
    private AutoPushRepositoryInterface $autoPushRepository;
    private WeeklyPushRepositoryInterface $weeklyPushRepository;

    public function __construct(
        UserRepositoryInterface $moderatorRepository,
        AppRepositoryInterface $appRepository,
        SegmentRepositoryInterface $segmentRepository,
        TemplateRepositoryInterface $templateRepository,
        CustomPushRepositoryInterface $customPushRepository,
        AutoPushRepositoryInterface $autoPushRepository,
        WeeklyPushRepositoryInterface $weeklyPushRepository
    )
    {
        $this->userRepository = $moderatorRepository;
        $this->appRepository = $appRepository;
        $this->segmentRepository = $segmentRepository;
        $this->templateRepository = $templateRepository;
        $this->customPushRepository = $customPushRepository;
        $this->autoPushRepository = $autoPushRepository;
        $this->weeklyPushRepository = $weeklyPushRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $moderators = $this->userRepository->getByUserPaginated($userDecorator, User::PAGINATE);
        return view('moderator.index', compact('moderators'));
    }

    public function create(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        $customPushes = $this->customPushRepository->getByUser($userDecorator);
        $weeklyPushes = $this->weeklyPushRepository->getByUser($userDecorator);
        $autoPushes = $this->autoPushRepository->getByUser($userDecorator);
        return view('moderator.create', compact(
            'apps',
            'segments',
            'templates',
            'customPushes',
            'weeklyPushes',
            'autoPushes'
        ));
    }

    public function store(StoreModeratorRequest $request){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $payload = $request->validated();
        $payload['password'] = Hash::make($payload['password']);
        $payload['role'] = config('roles.moderator');
        $moderator = $this->userRepository->save($payload);
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $payload['apps'] ?? []);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $payload['segments'] ?? []);
        $templates = $this->templateRepository->getByUserAndIds($userDecorator, $payload['templates'] ?? []);
        $customPushes = $this->customPushRepository->getByUserAndIds($userDecorator, $payload['customPushes'] ?? []);
        $autoPushes = $this->autoPushRepository->getByUserAndIds($userDecorator, $payload['autoPushes'] ?? []);
        $weeklyPushes = $this->weeklyPushRepository->getByUserAndIds($userDecorator, $payload['weeklyPushes'] ?? []);
        $moderatorDecorator = new ModeratorWrapper($moderator);
        $moderatorDecorator->apps()->sync($apps);
        $moderatorDecorator->segments()->sync($segments);
        $moderatorDecorator->templates()->sync($templates);
        $moderatorDecorator->customPushes()->sync($customPushes);
        $moderatorDecorator->autoPushes()->sync($autoPushes);
        $moderatorDecorator->weeklyPushes()->sync($weeklyPushes);
        return redirect()->route('moderator.index');
    }

}

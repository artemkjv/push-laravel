<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppsModeratorRequest;
use App\Http\Requests\StoreModeratorRequest;
use App\Http\Requests\UpdateModeratorRequest;
use App\Libraries\Decoration\ModeratorWrapper;
use App\Libraries\Decoration\UserInterface;
use App\Libraries\Decoration\UserWrapper;
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
        if(\request()->user()->role !== config('roles.moderator')){
            $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        } else {
            $userDecorator = new UserWrapper(\request()->user()->admin);
        }
        $moderators = $this->userRepository->getModeratorsByUserPaginated($userDecorator, User::PAGINATE);
        return view('moderator.index', compact('moderators'));
    }

    public function renderApps($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $adminDecorator = new UserWrapper(\request()->user()->admin);
        $moderator = $this->userRepository->getModeratorByIdAndUser($id, $adminDecorator);
        $moderatorWrapper = new ModeratorWrapper($moderator);
        $chosenApps = $this->appRepository->getByUser($moderatorWrapper);
        $apps = $this->appRepository->getByUser($userDecorator);
        return view('moderator.apps', compact('chosenApps', 'apps', 'moderator'));
    }

    public function handleApps(AppsModeratorRequest $request, $id){
        $payload = $request->validated();
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $adminDecorator = new UserWrapper(\request()->user()->admin);
        $moderator = $this->userRepository->getModeratorByIdAndUser($id, $adminDecorator);
        $moderatorWrapper = new ModeratorWrapper($moderator);
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $payload['apps']);
        foreach ($apps as $app){
            $moderatorWrapper->apps()->attach($app);
        }
        return redirect()->route('moderator.index');
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

    public function edit($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $moderator = $this->userRepository->getModeratorByIdAndUser($id, $userDecorator);
        $moderatorDecorator = new ModeratorWrapper($moderator);
        $chosenSegments = $this->segmentRepository->getByUser($moderatorDecorator);
        $chosenApps = $this->appRepository->getByUser($moderatorDecorator);
        $chosenTemplates = $this->templateRepository->getByUser($moderatorDecorator);
        $chosenCustomPushes = $this->customPushRepository->getByUser($moderatorDecorator);
        $chosenAutoPushes = $this->autoPushRepository->getByUser($moderatorDecorator);
        $chosenWeeklyPushes = $this->weeklyPushRepository->getByUser($moderatorDecorator);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $templates = $this->templateRepository->getByUser($userDecorator);
        $customPushes = $this->customPushRepository->getByUser($userDecorator);
        $weeklyPushes = $this->weeklyPushRepository->getByUser($userDecorator);
        $autoPushes = $this->autoPushRepository->getByUser($userDecorator);
        return view('moderator.edit', compact(
            'moderator',
            'apps',
            'segments',
            'templates',
            'customPushes',
            'weeklyPushes',
            'autoPushes',
            'chosenApps',
            'chosenSegments',
            'chosenTemplates',
            'chosenCustomPushes',
            'chosenAutoPushes',
            'chosenWeeklyPushes'
        ));
    }

    public function update(UpdateModeratorRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $payload = $request->validated();
        $moderator = $this->userRepository
            ->getModeratorByIdAndUser($id, $userDecorator)
            ->toArray();
        $moderator = $this->userRepository->save(array_merge($moderator, $payload));
        $moderatorDecorator = new ModeratorWrapper($moderator);
        $apps = $this->appRepository->getByUserAndIds($userDecorator, $payload['apps'] ?? []);
        $segments = $this->segmentRepository->getByUserAndIds($userDecorator, $payload['segments'] ?? []);
        $templates = $this->templateRepository->getByUserAndIds($userDecorator, $payload['templates'] ?? []);
        $customPushes = $this->customPushRepository->getByUserAndIds($userDecorator, $payload['customPushes'] ?? []);
        $autoPushes = $this->autoPushRepository->getByUserAndIds($userDecorator, $payload['autoPushes'] ?? []);
        $weeklyPushes = $this->weeklyPushRepository->getByUserAndIds($userDecorator, $payload['weeklyPushes'] ?? []);
        $moderatorDecorator->apps()->sync($apps);
        $moderatorDecorator->segments()->sync($segments);
        $moderatorDecorator->templates()->sync($templates);
        $moderatorDecorator->customPushes()->sync($customPushes);
        $moderatorDecorator->autoPushes()->sync($autoPushes);
        $moderatorDecorator->weeklyPushes()->sync($weeklyPushes);
        return redirect()->route('moderator.index');
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $moderator = $this->userRepository->getModeratorByIdAndUser($id, $userDecorator);
        $moderator->delete();
        return redirect()->back();
    }

}

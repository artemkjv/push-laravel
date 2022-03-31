<?php

namespace App\Http\Controllers;

use App\Libraries\Decoration\UserInterface;
use App\Models\PushUser;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use Illuminate\Http\Request;

class PushUserController extends Controller
{

    private PushUserRepositoryInterface $pushUserRepository;
    private SegmentRepositoryInterface $segmentRepository;
    private AppRepositoryInterface $appRepository;
    private CountryRepositoryInterface $countryRepository;
    private LanguageRepositoryInterface $languageRepository;
    private PlatformRepositoryInterface $platformRepositroy;

    public function __construct(
        PushUserRepositoryInterface $pushUserRepository,
        SegmentRepositoryInterface $segmentRepository,
        AppRepositoryInterface $appRepository,
        CountryRepositoryInterface $countryRepository,
        LanguageRepositoryInterface $languageRepository,
        PlatformRepositoryInterface $platformRepository
    )
    {
        $this->pushUserRepository = $pushUserRepository;
        $this->segmentRepository = $segmentRepository;
        $this->appRepository = $appRepository;
        $this->countryRepository = $countryRepository;
        $this->languageRepository = $languageRepository;
        $this->platformRepositroy = $platformRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $pushUsers = $this->pushUserRepository->getByUserPaginated(
            $userDecorator,
            \request()->get('limit') ?? PushUser::PAGINATE,
            \request()->get('segments'),
            \request()->get('apps'),
            \request()->get('countries'),
            \request()->get('languages'),
            \request()->get('platforms'),
            \request()->get('status')
        )->appends(request()->except('page'));
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $apps = $this->appRepository->getByUser($userDecorator);
        $countries = $this->countryRepository->getAll();
        $languages = $this->languageRepository->getAll();
        $platforms = $this->platformRepositroy->getAll();
        return view('pushUser.index', compact(
            'pushUsers',
            'segments',
            'apps',
            'countries',
            'languages',
            'platforms',
        ));
    }

    public function makeTest($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $pushUser = $this->pushUserRepository->getByIdAndUser($id, $userDecorator);
        $pushUser->is_test = true;
        $this->pushUserRepository->save($pushUser->toArray());
        return redirect()->back();
    }

    public function makeDefault($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $pushUser = $this->pushUserRepository->getByIdAndUser($id, $userDecorator);
        $pushUser->is_test = false;
        $this->pushUserRepository->save($pushUser->toArray());
        return redirect()->back();
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $pushUser = $this->pushUserRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $pushUser);
        $pushUser->delete();
        return redirect()->back();
    }

}

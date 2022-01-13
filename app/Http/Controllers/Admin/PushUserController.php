<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Decoration\UserWrapper;
use App\Models\PushUser;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;

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
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $pushUsers = $this->pushUserRepository->getByUserPaginated(
            $userDecorator,
            \request()->get('limit') ?? PushUser::PAGINATE,
            \request()->get('segments'),
            \request()->get('apps'),
            \request()->get('countries'),
            \request()->get('languages'),
            \request()->get('platforms')
        );
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $apps = $this->appRepository->getByUser($userDecorator);
        $countries = $this->countryRepository->getAll();
        $languages = $this->languageRepository->getAll();
        $platforms = $this->platformRepositroy->getAll();
        return view('admin.pushUser.index', compact(
            'pushUsers',
            'segments',
            'apps',
            'countries',
            'languages',
            'platforms',
            'user'
        ));
    }

    public function destroy($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $pushUser = $this->pushUserRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $pushUser);
        $pushUser->delete();
        return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PushUser;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;
use App\Repositories\PushTransitionRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\SentPushRepositoryInterface;
use App\Repositories\TimezoneRepositoryInterface;
use Illuminate\Http\Request;

class LegacyPushUserController extends Controller
{

    private PushUserRepositoryInterface $pushUserRepository;
    private CountryRepositoryInterface $countryRepository;
    private LanguageRepositoryInterface $languageRepository;
    private TimezoneRepositoryInterface $timezoneRepository;
    private SentPushRepositoryInterface $sentPushRepository;
    private PushTransitionRepositoryInterface $pushTransitionRepository;
    private AppRepositoryInterface $appRepository;
    private PlatformRepositoryInterface $platformRepository;

    public function __construct(
        PushUserRepositoryInterface $pushUserRepository,
        CountryRepositoryInterface $countryRepository,
        TimezoneRepositoryInterface $timezoneRepository,
        LanguageRepositoryInterface $languageRepository,
        SentPushRepositoryInterface $sentPushRepository,
        PushTransitionRepositoryInterface $pushTransitionRepository,
        AppRepositoryInterface $appRepository,
        PlatformRepositoryInterface $platformRepository
    )
    {
        $this->pushUserRepository = $pushUserRepository;
        $this->countryRepository = $countryRepository;
        $this->languageRepository = $languageRepository;
        $this->timezoneRepository = $timezoneRepository;
        $this->sentPushRepository = $sentPushRepository;
        $this->pushTransitionRepository = $pushTransitionRepository;
        $this->appRepository = $appRepository;
        $this->platformRepository = $platformRepository;
    }

    public function store(Request $request){
        $this->authorize('create', PushUser::class);
        $payload = $request->validate([
            'registration_id' => 'required',
            'internal_id' => 'nullable|uuid',
            'app_id' => 'required|exists:apps,uuid',
            'platform_type' => 'required|exists:platforms,name',
            'country' => 'required|string|exists:countries,code',
            'language' => 'required|string|exists:languages,code',
            'timezone' => 'required|string|exists:timezones,name',
            'device_model' => 'nullable|string'
        ]);
        $country = $this->countryRepository->getByCode($payload['country']);
        $language  = $this->languageRepository->getByCode($payload['language']);
        $timezone = $this->timezoneRepository->getByName($payload['timezone']);
        $platform = $this->platformRepository->getByName($payload['platform_type']);
        $app = $this->appRepository->getByUUID($payload['app_id']);
        $this->pushUserRepository->save([
            'registration_id' => $payload['registration_id'],
            'app_id' => $app->id,
            'country_id' => $country->id,
            'language_id' => $language->id,
            'timezone_id' => $timezone->id,
            'platform_id' => $platform->id,
            'uuid' => $payload['internal_id'] ?? null,
            'device_model' => $payload['device_model']
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function addSession($registrationId){
        $pushUser = $this->pushUserRepository->getByRegistrationId($registrationId);
        $pushUser->sessions_count++;
        $this->pushUserRepository->save($pushUser->toArray());
        return response()->json([
            'status' => 'success',
            'internal_id' => $pushUser->uuid
        ]);
    }

    public function update(Request $request){
        $payload = $request->validate([
            'old_registration_id' => 'required|exists:push_users,registration_id',
            'registration_id' => 'required'
        ]);
        $pushUser = $this->pushUserRepository->getByRegistrationId($payload['old_registration_id']);
        $pushUser->registration_id = $payload['registration_id'];
        $pushUser->save();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function addTag(Request $request){
        $payload = $request->validate([
            'key' => 'required',
            'value' => 'required',
            'registration_id' => 'required|exists:push_users,registration_id',
        ]);
        $pushUser = $this->pushUserRepository->getByRegistrationId($payload['registration_id']);
        $pushUser->tags[$payload['key']] = $payload['value'];
        $pushUser->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function addTransition(Request $request, $registrationId){
        $payload = $request->validate([
            'push_type' => 'required|string',
            'push_id' => 'required|integer'
        ]);
        $pushUser = $this->pushUserRepository->getByRegistrationId($registrationId);
        \DB::transaction(function () use ($pushUser, $payload){
            $this->pushTransitionRepository->save([
                'push_user_id' => $pushUser->id,
                'clicked_at' => new \DateTime()
            ]);
            $sentPush = $this->sentPushRepository
                ->getByPushableIdAndType($payload['pushable_id'], $payload['pushable_type']);
            $sentPush->clicked++;
            $this->sentPushRepository->save($sentPush->toArray());
        });
        return response()->json([
            'status' => 'success',
            'internal_id' => $pushUser->uuid
        ]);
    }

    public function addTime(Request $request){
        $payload = $request->validate([
            'registration_id' => 'required|exists:push_users,registration_id',
            'time' => 'required|integer'
        ]);
        $pushUser = $this->pushUserRepository->getByRegistrationId($payload['registration_id']);
        $pushUser->time_in_app += $payload['time'];
        $this->pushUserRepository->save($pushUser->toArray());
        return response()->json([
            'status' => 'success'
        ]);
    }

}

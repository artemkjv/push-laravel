<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Legacy\StorePushUserRequest;
use App\Http\Requests\Legacy\TagPushUserRequest;
use App\Http\Requests\Legacy\TimePushUserRequest;
use App\Http\Requests\Legacy\UpdatePushUserRequest;
use App\Http\Requests\TransitionPushUserRequest;
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

    public function store(StorePushUserRequest $request){
        $payload = $request->validated();
        $app = $this->appRepository->getByUUID($payload['app_id']);
        if($app->user->tariff != null && $app->user->pushUsers()->count() >= $app->user->tariff->max_push_users) abort(403);
        $country = $this->countryRepository->getByCode($payload['country']);
        $language  = $this->languageRepository->getByCode($payload['language']);
        $timezone = $this->timezoneRepository->getByName($payload['timezone']);
        $platform = $this->platformRepository->getByName($payload['platform_type']);
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

    public function update(UpdatePushUserRequest $request){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository->getByRegistrationId($payload['old_registration_id']);
        $pushUser->registration_id = $payload['registration_id'];
        $pushUser->save();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function addTag(TagPushUserRequest $request){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository->getByRegistrationId($payload['registration_id']);
        $tags = $pushUser->tags;
        $tags[$payload['key']] = $payload['value'];
        $pushUser->tags = $tags;
        $pushUser->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function addTransition(TransitionPushUserRequest $request, $registrationId){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository->getByRegistrationId($registrationId);
        \DB::transaction(function () use ($pushUser, $payload){
            $this->pushTransitionRepository->save([
                'push_user_id' => $pushUser->id,
                'clicked_at' => new \DateTime()
            ]);
            $sentPush = $this->sentPushRepository
                ->getByPushableIdAndType($payload['push_id'], $payload['push_type']);
            $sentPush->clicked++;
            $this->sentPushRepository->save($sentPush->toArray());
        });
        return response()->json([
            'status' => 'success',
            'internal_id' => $pushUser->uuid
        ]);
    }

    public function addTime(TimePushUserRequest $request){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository->getByRegistrationId($payload['registration_id']);
        $pushUser->time_in_app += $payload['time'];
        $this->pushUserRepository->save($pushUser->toArray());
        return response()->json([
            'status' => 'success'
        ]);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePushUserRequest;
use App\Http\Requests\TagPushUserRequest;
use App\Http\Requests\TimePushUserRequest;
use App\Http\Requests\TransitionPushUserRequest;
use App\Http\Requests\UpdatePushUserRequest;
use App\Models\PushUser;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\PushTransitionRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\SentPushRepositoryInterface;
use App\Repositories\TimezoneRepositoryInterface;
use Illuminate\Http\Request;

class PushUserController extends Controller
{

    private PushUserRepositoryInterface $pushUserRepository;
    private CountryRepositoryInterface $countryRepository;
    private LanguageRepositoryInterface $languageRepository;
    private TimezoneRepositoryInterface $timezoneRepository;
    private SentPushRepositoryInterface $sentPushRepository;
    private PushTransitionRepositoryInterface $pushTransitionRepository;
    private AppRepositoryInterface $appRepository;

    public function __construct(
        PushUserRepositoryInterface $pushUserRepository,
        CountryRepositoryInterface $countryRepository,
        TimezoneRepositoryInterface $timezoneRepository,
        LanguageRepositoryInterface $languageRepository,
        SentPushRepositoryInterface $sentPushRepository,
        PushTransitionRepositoryInterface $pushTransitionRepository,
        AppRepositoryInterface $appRepository
    )
    {
        $this->pushUserRepository = $pushUserRepository;
        $this->countryRepository = $countryRepository;
        $this->languageRepository = $languageRepository;
        $this->timezoneRepository = $timezoneRepository;
        $this->sentPushRepository = $sentPushRepository;
        $this->pushTransitionRepository = $pushTransitionRepository;
        $this->appRepository = $appRepository;
    }

    public function store(StorePushUserRequest $request){
        $payload = $request->validated();
        $app = $this->appRepository->getByUUID($payload['app_id']);
        if($app->user->tariff != null && $app->user->pushUsers()->count() >= $app->user->tariff->max_push_users) abort(403);
        $country = $this->countryRepository->getByCode($payload['country']);
        $language  = $this->languageRepository->getByCode($payload['language']);
        $timezone = $this->timezoneRepository->getByName($payload['timezone']);
        $payload['country_id'] = $country->id;
        $payload['language_id'] = $language->id;
        $payload['timezone_id'] = $timezone->id;
        $payload['app_id'] = $app->id;
        $this->pushUserRepository->save($payload);
        return response()->noContent();
    }

    public function addSession($registrationId){
        $pushUser = $this->pushUserRepository->getByRegistrationId($registrationId);
        $pushUser->sessions_count++;
        $pushUser->active_at = (new \DateTime())->format('Y-m-d H:i:s');
        $this->pushUserRepository->save($pushUser->toArray());
        return response()->noContent();
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
                ->getById($payload['sent_push_id']);
            $sentPush->clicked++;
            $this->sentPushRepository->save($sentPush->toArray());
        });
        return response()->noContent();
    }

    public function update(UpdatePushUserRequest $request, $registrationId){
        $pushUser = $this->pushUserRepository
            ->getByRegistrationId($registrationId)
            ->toArray();
        $payload = $request->validated();
        $this->pushUserRepository->save(array_merge($pushUser, $payload));
        return response()->noContent();
    }

    public function addTag(TagPushUserRequest $request, $registrationId){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository
            ->getByRegistrationId($registrationId);
        $tags = $pushUser->tags;
        $tags[$payload['key']] = $payload['value'];
        $pushUser->tags = $tags;
        $pushUser->save();
        return response()->noContent();
    }

    public function addTagByInternalId(TagPushUserRequest $request, $internalId){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository
            ->getByUUID($internalId);
        $tags = $pushUser->tags;
        $tags[$payload['key']] = $payload['value'];
        $pushUser->tags = $tags;
        $pushUser->save();
        return response()->noContent();
    }


    public function addTime(TimePushUserRequest $request, $registrationId){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository->getByRegistrationId($registrationId);
        $pushUser->time_in_app += $payload['time_in_app'];
        $pushUser->save();
        return response()->noContent();
    }

}

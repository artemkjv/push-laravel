<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePushUserRequest;
use App\Http\Requests\TagPushUserRequest;
use App\Http\Requests\TimePushUserRequest;
use App\Http\Requests\TransitionPushUserRequest;
use App\Http\Requests\UpdatePushUserRequest;
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

    public function __construct(
        PushUserRepositoryInterface $pushUserRepository,
        CountryRepositoryInterface $countryRepository,
        TimezoneRepositoryInterface $timezoneRepository,
        LanguageRepositoryInterface $languageRepository,
        SentPushRepositoryInterface $sentPushRepository,
        PushTransitionRepositoryInterface $pushTransitionRepository
    )
    {
        $this->pushUserRepository = $pushUserRepository;
        $this->countryRepository = $countryRepository;
        $this->languageRepository = $languageRepository;
        $this->timezoneRepository = $timezoneRepository;
        $this->sentPushRepository = $sentPushRepository;
        $this->pushTransitionRepository = $pushTransitionRepository;
    }

    public function store(StorePushUserRequest $request){
        $payload = $request->validated();
        $country = $this->countryRepository->getByCode($payload['country']);
        $language  = $this->languageRepository->getByCode($payload['language']);
        $timezone = $this->timezoneRepository->getByName($payload['timezone']);
        $payload['country_id'] = $country->id;
        $payload['language_id'] = $language->id;
        $payload['timezone_id'] = $timezone->id;
        $this->pushUserRepository->save($payload);
        return response()->noContent();
    }

    public function addSession($uuid){
        $pushUser = $this->pushUserRepository->getByUUID($uuid);
        $pushUser->sessions_count++;
        $this->pushUserRepository->save($pushUser->toArray());
        return response()->noContent();
    }

    public function addTransition(TransitionPushUserRequest $request, $uuid){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository->getByUUID($uuid);
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
        return response()->noContent();
    }

    public function update(UpdatePushUserRequest $request, $uuid){
        $pushUser = $this->pushUserRepository
            ->getByUUID($uuid)
            ->toArray();
        $payload = $request->validated();
        $this->pushUserRepository->save(array_merge($pushUser, $payload));
        return response()->noContent();
    }

    public function addTag(TagPushUserRequest $request, $uuid){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository
            ->getByUUID($uuid);
        $pushUser->tags[$payload['key']] = $payload['value'];
        $this->pushUserRepository->save($pushUser->toArray());
        return response()->noContent();
    }

    public function addTime(TimePushUserRequest $request, $uuid){
        $payload = $request->validated();
        $pushUser = $this->pushUserRepository->getByUUID($uuid);
        $pushUser->time_in_app += $payload['time_in_app'];
        $this->pushUserRepository->save($pushUser->toArray());
        return response()->noContent();
    }

}

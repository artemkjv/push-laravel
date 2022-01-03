<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePushUserRequest;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\TimezoneRepositoryInterface;
use Illuminate\Http\Request;

class PushUserController extends Controller
{

    private PushUserRepositoryInterface $pushUserRepository;
    private CountryRepositoryInterface $countryRepository;
    private LanguageRepositoryInterface $languageRepository;
    private TimezoneRepositoryInterface $timezoneRepository;

    public function __construct(
        PushUserRepositoryInterface $pushUserRepository,
        CountryRepositoryInterface $countryRepository,
        TimezoneRepositoryInterface $timezoneRepository,
        LanguageRepositoryInterface $languageRepository
    )
    {
        $this->pushUserRepository = $pushUserRepository;
        $this->countryRepository = $countryRepository;
        $this->languageRepository = $languageRepository;
        $this->timezoneRepository = $timezoneRepository;
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

}

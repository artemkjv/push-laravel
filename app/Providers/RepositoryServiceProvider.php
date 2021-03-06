<?php

namespace App\Providers;

use App\Repositories\ApiPageRepositoryInterface;
use App\Repositories\ApiTokenRepositoryInterface;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\AutoPushRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\CustomPushRepositoryInterface;
use App\Repositories\Eloquent\ApiPageRepository;
use App\Repositories\Eloquent\ApiTokenRepository;
use App\Repositories\Eloquent\AppRepository;
use App\Repositories\Eloquent\AutoPushRepository;
use App\Repositories\Eloquent\CountryRepository;
use App\Repositories\Eloquent\CustomPushRepository;
use App\Repositories\Eloquent\FilterRepository;
use App\Repositories\Eloquent\FilterTypeRepository;
use App\Repositories\Eloquent\LanguageRepository;
use App\Repositories\Eloquent\SentPushRepository;
use App\Repositories\Eloquent\TariffRepository;
use App\Repositories\Eloquent\TimezoneRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\PlatformRepository;
use App\Repositories\Eloquent\PushTransitionRepository;
use App\Repositories\Eloquent\PushUserRepository;
use App\Repositories\Eloquent\SegmentRepository;
use App\Repositories\Eloquent\TemplateRepository;
use App\Repositories\Eloquent\WeeklyPushRepository;
use App\Repositories\FilterRepositoryInterface;
use App\Repositories\FilterTypeRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\SentPushRepositoryInterface;
use App\Repositories\TariffRepositoryInterface;
use App\Repositories\TimezoneRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;
use App\Repositories\PushTransitionRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use App\Repositories\TemplateRepositoryInterface;
use App\Repositories\WeeklyPushRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PlatformRepositoryInterface::class,
            PlatformRepository::class
        );
        $this->app->bind(
            AppRepositoryInterface::class,
            AppRepository::class
        );
        $this->app->bind(
            SegmentRepositoryInterface::class,
            SegmentRepository::class
        );
        $this->app->bind(
            FilterTypeRepositoryInterface::class,
            FilterTypeRepository::class
        );
        $this->app->bind(
            FilterRepositoryInterface::class,
            FilterRepository::class
        );
        $this->app->bind(
            TemplateRepositoryInterface::class,
            TemplateRepository::class
        );
        $this->app->bind(
            LanguageRepositoryInterface::class,
            LanguageRepository::class
        );
        $this->app->bind(
            PushUserRepositoryInterface::class,
            PushUserRepository::class
        );
        $this->app->bind(
            CustomPushRepositoryInterface::class,
            CustomPushRepository::class
        );
        $this->app->bind(
            WeeklyPushRepositoryInterface::class,
            WeeklyPushRepository::class
        );
        $this->app->bind(
            AutoPushRepositoryInterface::class,
            AutoPushRepository::class
        );
        $this->app->bind(
            PushTransitionRepositoryInterface::class,
            PushTransitionRepository::class
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            CountryRepositoryInterface::class,
            CountryRepository::class
        );
        $this->app->bind(
            TimezoneRepositoryInterface::class,
            TimezoneRepository::class
        );
        $this->app->bind(
            PushUserRepositoryInterface::class,
            PushUserRepository::class
        );
        $this->app->bind(
            SentPushRepositoryInterface::class,
            SentPushRepository::class
        );
        $this->app->bind(
            TariffRepositoryInterface::class,
            TariffRepository::class
        );
        $this->app->bind(
            ApiTokenRepositoryInterface::class,
            ApiTokenRepository::class,
        );
        $this->app->bind(
            ApiPageRepositoryInterface::class,
            ApiPageRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

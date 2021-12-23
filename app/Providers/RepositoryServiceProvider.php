<?php

namespace App\Providers;

use App\Repositories\AppRepositoryInterface;
use App\Repositories\CustomPushRepositoryInterface;
use App\Repositories\Eloquent\AppRepository;
use App\Repositories\Eloquent\CustomPushRepository;
use App\Repositories\Eloquent\FilterRepository;
use App\Repositories\Eloquent\FilterTypeRepository;
use App\Repositories\Eloquent\LanguageRepository;
use App\Repositories\Eloquent\PlatformRepository;
use App\Repositories\Eloquent\PushUserRepository;
use App\Repositories\Eloquent\SegmentRepository;
use App\Repositories\Eloquent\TemplateRepository;
use App\Repositories\FilterRepositoryInterface;
use App\Repositories\FilterTypeRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use App\Repositories\TemplateRepositoryInterface;
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

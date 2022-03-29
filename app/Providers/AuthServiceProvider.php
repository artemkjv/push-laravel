<?php

namespace App\Providers;

use App\Models\App;
use App\Models\AutoPush;
use App\Models\CustomPush;
use App\Models\PushUser;
use App\Models\Segment;
use App\Models\SentPush;
use App\Models\Tariff;
use App\Models\Template;
use App\Models\WeeklyPush;
use App\Policies\AppPolicy;
use App\Policies\AutoPushPolicy;
use App\Policies\CustomPushPolicy;
use App\Policies\PushUserPolicy;
use App\Policies\SegmentPolicy;
use App\Policies\SentPushPolicy;
use App\Policies\TariffPolicy;
use App\Policies\TemplatePolicy;
use App\Policies\WeeklyPushPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        App::class => AppPolicy::class,
        AutoPush::class => AutoPushPolicy::class,
        WeeklyPush::class => WeeklyPushPolicy::class,
        Segment::class => SegmentPolicy::class,
        Template::class => TemplatePolicy::class,
        CustomPush::class => CustomPushPolicy::class,
        PushUser::class => PushUserPolicy::class,
        SentPush::class => SentPushPolicy::class,
        Tariff::class => TariffPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}

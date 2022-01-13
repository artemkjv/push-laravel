<?php

namespace App\Providers;

use App\Models\App;
use App\Models\AutoPush;
use App\Models\CustomPush;
use App\Models\PushUser;
use App\Models\Segment;
use App\Models\SentPush;
use App\Models\Template;
use App\Models\WeeklyPush;
use App\Policies\ModelPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        App::class => ModelPolicy::class,
        AutoPush::class => ModelPolicy::class,
        WeeklyPush::class => ModelPolicy::class,
        Segment::class => ModelPolicy::class,
        Template::class => ModelPolicy::class,
        CustomPush::class => ModelPolicy::class,
        PushUser::class => ModelPolicy::class,
        SentPush::class => ModelPolicy::class
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

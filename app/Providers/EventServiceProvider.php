<?php

namespace App\Providers;

use App\Models\App;
use App\Models\CustomPush;
use App\Models\Segment;
use App\Models\Template;
use App\Models\WeeklyPush;
use App\Observers\AppObserver;
use App\Observers\CustomPushObserver;
use App\Observers\SegmentObserver;
use App\Observers\TemplateObserver;
use App\Observers\WeeklyPushObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        App::observe(AppObserver::class);
        Segment::observe(SegmentObserver::class);
        Template::observe(TemplateObserver::class);
        CustomPush::observe(CustomPushObserver::class);
        WeeklyPush::observe(WeeklyPushObserver::class);
    }
}

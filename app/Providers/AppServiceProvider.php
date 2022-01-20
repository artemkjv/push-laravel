<?php

namespace App\Providers;
use App\Http\Requests\BaseRequest\JsonRequest;
use App\Libraries\Firebase\MessagingService;
use App\Libraries\Helpers\TimezoneHelper;
use ConsoleTVs\Charts\Registrar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Registrar $charts)
    {
        Horizon::auth(function ($request) {
            return config('app.env') === 'local';
        });

        if(is_null(session('timezone'))){
            $ip = request()->getClientIp();
            $timezoneHelper = TimezoneHelper::instance();
            session('timezone', $timezoneHelper->getTimezoneFromIp($ip));
        }


        $charts->register([
            \App\Charts\HomeChart::class
        ]);

        $this->app->bind(MessagingService::class, MessagingService::class);
    }
}

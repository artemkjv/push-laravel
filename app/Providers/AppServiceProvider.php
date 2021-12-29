<?php

namespace App\Providers;
use ConsoleTVs\Charts\Registrar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        $charts->register([
            \App\Charts\HomeChart::class
        ]);
    }
}

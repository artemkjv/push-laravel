<?php

namespace App\Http\Middleware;

use App\Libraries\Helpers\IPHelper;
use App\Libraries\Helpers\TimezoneHelper;
use Closure;
use Illuminate\Http\Request;

class TimezoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('timezone')){
            $ipHelper = IPHelper::instance();
            $ip = $ipHelper->ip();
            $timezoneHelper = TimezoneHelper::instance();
            session()->put('timezone', $timezoneHelper->getTimezoneFromIp($ip));
        }
        return $next($request);
    }
}

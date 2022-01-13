<?php

namespace App\Http\Middleware;

use App\Libraries\Decoration\AdminWrapper;
use App\Libraries\Decoration\ManagerWrapper;
use App\Libraries\Decoration\ModeratorWrapper;
use App\Libraries\Decoration\UserInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class UserWrapper
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
        $user = $request->user();
        App::bind(UserInterface::class, function ($app) use ($user){
            if($user){
                switch ($user->role){
                    case config('roles.user'):
                        return new \App\Libraries\Decoration\UserWrapper($user);
                    case config('roles.moderator'):
                        return new ModeratorWrapper($user);
                    case config('roles.admin'):
                        return new AdminWrapper($user);
                    case config('roles.manager'):
                        return new ManagerWrapper($user);
                }
            }
            return null;
        });
        return $next($request);
    }
}

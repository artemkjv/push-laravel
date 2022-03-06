<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ApiAuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return RedirectResponse|Response|\never
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('Authorization', '');
        $user = User::getByApiKey($apiKey);
        if($user){
            Auth::login($user);
            return $next($request);
        }
        return abort(403);
    }
}

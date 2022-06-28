<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Repositories\ApiPageRepositoryInterface;
use App\Repositories\ApiTokenRepositoryInterface;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ApiAuthenticateMiddleware
{

    private ApiTokenRepositoryInterface $apiTokenRepository;
    private ApiPageRepositoryInterface $apiPageRepository;

    public function __construct(
        ApiTokenRepositoryInterface $apiTokenRepository,
        ApiPageRepositoryInterface $apiPageRepository
    )
    {
        $this->apiTokenRepository = $apiTokenRepository;
        $this->apiPageRepository = $apiPageRepository;
    }

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
        $userWrapper = new UserWrapper();
        if($user){
            Auth::login($user);
            return $userWrapper->handle($request, $next);
        }
        try {
            $apiToken = $this->apiTokenRepository->getByTokenNotExpired($apiKey);
            $this->apiPageRepository->getByApiTokenAndRoute($apiToken, request()->route()->getName());
            Auth::login($apiToken->user);
            return $userWrapper->handle($request, $next);
        } catch (ModelNotFoundException $e) { }
        return abort(403);
    }
}

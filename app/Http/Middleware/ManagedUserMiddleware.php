<?php

namespace App\Http\Middleware;

use App\Libraries\Decoration\UserInterface;
use App\Repositories\UserRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ManagedUserMiddleware
{

    private UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $selfDecorator = App::make(UserInterface::class);
        $user = $this->userRepository->getManagedUserByIdAndUser($request->userId, $selfDecorator);
        $request->currentUser = $user;
        return $next($request);
    }
}

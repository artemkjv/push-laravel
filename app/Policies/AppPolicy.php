<?php

namespace App\Policies;

use App\Models\App;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AppPolicy
{
    use HandlesAuthorization, ModelPolicy;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){
        if($user->role === config('roles.moderator')){
            $user = $user->admin;
        }
        $tariff = $user->tariff;
        if(is_null($tariff)){
            return true;
        }
        return $user->apps()->count() < $tariff->max_apps;
    }

    public function delete(User $user, App $app){
        if($app->customPushes()->count() || $app->autoPushes()->count() || $app->weeklyPushes()->count()) {
            return Response::deny('Can\'t delete app with existing relations.');
        }
        return true;
    }


}

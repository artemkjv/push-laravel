<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AutoPushPolicy
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
        return $user->autoPushes()->count() < $tariff->max_pushes;
    }


}

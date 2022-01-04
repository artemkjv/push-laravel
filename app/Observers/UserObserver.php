<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saving(User $user){
        $user->last_ip = request()->ip();
        $user->last_login_at = new \DateTime();
    }

    public function creating(User $user){
        if($user->role === config('roles.moderator')){
            $user->admin_id = request()->user()->id;
        }
    }

}

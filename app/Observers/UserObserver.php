<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saving(User $user){
        $user->last_ip = request()->ip();
        $user->last_login_at = new \DateTime();
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait ModelPolicy
{

    public function delete(User $user, Model $model){
        return $user->role !== config('roles.moderator');
    }

}

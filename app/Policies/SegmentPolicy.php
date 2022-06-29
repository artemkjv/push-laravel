<?php

namespace App\Policies;

use App\Models\Segment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class SegmentPolicy
{
    use HandlesAuthorization, ModelPolicy;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function create(User $user){
        if($user->role === config('roles.moderator')){
            $user = $user->admin;
        }
        $tariff = $user->tariff;
        if(is_null($tariff)){
            return true;
        }
        return $user->segments()->count() < $tariff->max_segments;
    }

    public function delete(User $user, Segment $segment){
        if($segment->customPushes()->count() || $segment->autoPushes()->count() || $segment->weeklyPushes()->count()) {
            return Response::deny('Can\'t delete segment with existing relations.');
        }
        return true;
    }

}

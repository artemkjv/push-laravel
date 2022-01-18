<?php

namespace App\Observers;

use App\Libraries\Decoration\ModeratorWrapper;
use App\Models\Segment;

class SegmentObserver
{
    public function saving(Segment $segment){
        $currentUser = request()->user();
        $segment->user_modified_id = $currentUser->id;
    }

    public function creating(Segment $segment){
        $currentUser = request()->currentUser ?? request()->user();
        $segment->user_id = $currentUser->role === config('roles.moderator') ? $currentUser->admin->id : $currentUser->id;
    }

    public function created(Segment $segment){
        $currentUser = request()->user();
        if($currentUser->role === config('roles.moderator')){
            $moderatorWrapper = new ModeratorWrapper($currentUser);
            $moderatorWrapper->segments()->attach($segment);
        }
    }

}

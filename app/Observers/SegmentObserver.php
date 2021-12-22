<?php

namespace App\Observers;

use App\Models\Segment;

class SegmentObserver
{
    public function saving(Segment $segment){
        $currentUser = request()->user();
        $segment->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
        $segment->user_modified_id = $currentUser->id;
    }
}

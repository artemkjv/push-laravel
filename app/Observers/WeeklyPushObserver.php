<?php

namespace App\Observers;

use App\Models\WeeklyPush;

class WeeklyPushObserver
{
    public function saving(WeeklyPush $weeklyPush){
        $currentUser = request()->user();
        $weeklyPush->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
    }
}

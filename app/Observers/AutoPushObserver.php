<?php

namespace App\Observers;

use App\Models\AutoPush;

class AutoPushObserver
{
    public function saving(AutoPush $autoPush){
        $currentUser = request()->user();
        $autoPush->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
        $autoPush->user_modified_id = $currentUser->id;
        $autoPush->time_to_send = (new \DateTime())->format('Y-m-d H:i:s');
    }
}

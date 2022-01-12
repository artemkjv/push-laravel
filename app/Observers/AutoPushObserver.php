<?php

namespace App\Observers;

use App\Jobs\SendAutoPush;
use App\Models\AutoPush;

class AutoPushObserver
{
    public function saving(AutoPush $autoPush){
        $currentUser = request()->user();
        $autoPush->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
        $autoPush->user_modified_id = $currentUser->id;
        if($autoPush->getOriginal('interval_value') != $autoPush->interval_value
            || $autoPush->getOriginal('interval_type') != $autoPush->interval_type){
            $autoPush->interval_updated_at = (new \DateTime())->format('Y-m-d H:i:s');
        }
    }

    public function saved(AutoPush $autoPush){
        if($autoPush->getOriginal('interval_value') != $autoPush->interval_value
            || $autoPush->getOriginal('interval_type') != $autoPush->interval_type){
            SendAutoPush::dispatch($autoPush)->delay($autoPush->getTimeToSend());
        }
    }

}

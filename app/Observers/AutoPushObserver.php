<?php

namespace App\Observers;

use App\Jobs\SendAutoPush;
use App\Libraries\Decoration\ModeratorWrapper;
use App\Models\AutoPush;

class AutoPushObserver
{
    public function saving(AutoPush $autoPush){
        $currentUser = request()->user();
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

    public function creating(AutoPush $autoPush){
        $currentUser = request()->currentUser ?? request()->user();
        $autoPush->user_id = $currentUser->role === config('roles.moderator') ? $currentUser->admin->id : $currentUser->id;
    }

    public function created(AutoPush $autoPush){
        $currentUser = request()->user();
        if($currentUser->role === config('roles.moderator')){
            $moderatorWrapper = new ModeratorWrapper($currentUser);
            $moderatorWrapper->autoPushes()->attach($autoPush);
        }
    }

}

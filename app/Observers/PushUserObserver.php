<?php

namespace App\Observers;

use App\Models\PushUser;

class PushUserObserver
{

    public function creating(PushUser $pushUser){
        $pushUser->active_at = new \DateTime();
        $pushUser->time_in_app = 0;
        $pushUser->sessions_count = 1;
    }

}

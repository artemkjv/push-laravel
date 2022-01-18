<?php

namespace App\Observers;

use App\Jobs\CreatedPushUser;
use App\Models\PushUser;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PushUserObserver
{

    public function creating(PushUser $pushUser){
        $pushUser->active_at = new \DateTime();
        if(is_null($pushUser->uuid)){
            $pushUser->uuid = Str::orderedUuid();
        }
        $pushUser->time_in_app = 0;
        $pushUser->sessions_count = 1;
    }

    public function created(PushUser $pushUser){
        CreatedPushUser::dispatch($pushUser)->delay((new \DateTimeImmutable())->modify('+10 minutes'));
    }

}

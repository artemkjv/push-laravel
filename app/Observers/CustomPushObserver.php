<?php

namespace App\Observers;

use App\Models\CustomPush;
use Illuminate\Support\Facades\App;

class CustomPushObserver
{

    public function saving(CustomPush $customPush){
        $currentUser = request()->user();
        $customPush->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
        $customPush->user_modified_id = $currentUser->id;
    }

    public function saved(CustomPush $customPush){
        if($customPush->getOriginal('time_to_send') !==
            (new \DateTime($customPush->time_to_send))->format('Y-m-d H:i:s')){

        }
    }

}

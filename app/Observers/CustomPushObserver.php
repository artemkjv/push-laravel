<?php

namespace App\Observers;

use App\Models\CustomPush;

class CustomPushObserver
{

    public function saving(CustomPush $customPush){
        $currentUser = request()->user();
        $customPush->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
    }

}

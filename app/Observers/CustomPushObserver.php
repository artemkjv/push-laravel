<?php

namespace App\Observers;

use App\Jobs\CreateCustomPush;
use App\Models\CustomPush;
use Illuminate\Support\Facades\App;

class CustomPushObserver
{

    public function saving(CustomPush $customPush){
        $currentUser = request()->user();
        $customPush->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
        $customPush->user_modified_id = $currentUser->id;
    }

    public function created(CustomPush $customPush)
    {
        CreateCustomPush::dispatch($customPush);
    }

}

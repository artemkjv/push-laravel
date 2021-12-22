<?php

namespace App\Observers;

use App\Models\App;
use Illuminate\Support\Str;

class AppObserver
{

   public function saving(App $app){
       $currentUser = request()->user();
       $app->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
       $app->user_modified_id = $currentUser->id;
       $app->uuid = Str::orderedUuid();
   }

}

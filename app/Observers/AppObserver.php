<?php

namespace App\Observers;

use App\Libraries\Decoration\ModeratorWrapper;
use App\Models\App;
use Illuminate\Support\Str;

class AppObserver
{

   public function saving(App $app){
       $currentUser = request()->user();
       $app->user_modified_id = $currentUser->id;
       $app->uuid = Str::orderedUuid();
   }

   public function creating(App $app){
       $currentUser = request()->currentUser ?? request()->user();
       $app->user_id = $currentUser->role === config('roles.moderator') ? $currentUser->admin->id : $currentUser->id;
   }

   public function created(App $app){
       $currentUser = request()->user();
       if($currentUser->role === config('roles.moderator')){
           $moderatorWrapper = new ModeratorWrapper($currentUser);
           $moderatorWrapper->apps()->attach($app);
       }
   }

}

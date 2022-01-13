<?php

namespace App\Observers;

use App\Libraries\Decoration\ModeratorWrapper;
use App\Models\Template;

class TemplateObserver
{
    public function saving(Template $template){
        $currentUser = request()->user();
        $template->user_modified_id = $currentUser->id;
    }

    public function creating(Template $template){
        $currentUser = request()->currentUser ?? request()->user();
        $template->user_id = $currentUser->role === config('roles.moderator') ? $currentUser->admin->id : $currentUser->id;
    }

    public function created(Template $template){
        $currentUser = request()->user();
        if($currentUser->role = config('roles.moderator')){
            $moderatorWrapper = new ModeratorWrapper($currentUser);
            $moderatorWrapper->templates()->attach($template);
        }
    }

}

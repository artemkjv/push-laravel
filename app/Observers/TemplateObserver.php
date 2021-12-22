<?php

namespace App\Observers;

use App\Models\Template;

class TemplateObserver
{
    public function saving(Template $template){
        $currentUser = request()->user();
        $template->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
        $template->user_modified_id = $currentUser->id;
    }
}

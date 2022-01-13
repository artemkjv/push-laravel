<?php


namespace App\Services;

class TemplateService
{

    public function handleUploadedImage($image){
        if(!is_null($image)){
            return $image->store('images', 'public');
        }
    }

    public function handleUploadedIcon($icon){
        if(!is_null($icon)){
            return $icon->store('icons', 'public');
        }
    }

}

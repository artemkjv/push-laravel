<?php


namespace App\Services;


class CustomPushService
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

    public function handleIsTest(&$payload){
        isset($payload['is_test']) ? $payload['is_test'] = true : $payload['is_test'] = false;
    }

}

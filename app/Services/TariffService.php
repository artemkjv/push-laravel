<?php


namespace App\Services;


class TariffService
{

    public function handleIsDefault(&$payload){
        if(isset($payload['is_default']) && $payload['is_default'] === 'on'){
            $payload['is_default'] = true;
        } else {
            $payload['is_default'] = null;
        }
    }

}

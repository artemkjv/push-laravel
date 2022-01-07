<?php


namespace App\Jobs\Helper;


use App\Models\Pushable;

trait PushUserTrait
{

    public function send($pushUsers, Pushable $pushable){
        $sortedArray = [];
        foreach($pushUsers as $pushUser){
            $sortedArray[$pushUser->app->server_key][$pushUser->language->id][] = $pushUser;
        }
        foreach ($sortedArray as $serverKey => $languages){
            foreach ($languages as $langId => $pushUsers){
                $chunkedArray = array_chunk($pushUsers, 1000);
                foreach ($chunkedArray as $chunkedPushUsers){
                    $this->messagingService->send($pushable, $langId, $serverKey, $chunkedPushUsers);
                }
            }
        }
    }

}

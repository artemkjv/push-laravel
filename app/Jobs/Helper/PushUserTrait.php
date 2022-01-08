<?php


namespace App\Jobs\Helper;


use App\Libraries\Firebase\MessagingService;
use App\Models\Pushable;
use Illuminate\Support\Facades\App;

trait PushUserTrait
{

    public function send($pushUsers, Pushable $pushable){
        $messagingService = App::make(MessagingService::class);
        $sortedArray = [];
        foreach($pushUsers as $pushUser){
            $sortedArray[$pushUser->app->server_key][$pushUser->language->id][] = $pushUser;
        }
        foreach ($sortedArray as $serverKey => $languages){
            foreach ($languages as $langId => $pushUsers){
                $chunkedArray = array_chunk($pushUsers, 1000);
                foreach ($chunkedArray as $chunkedPushUsers){
                    $messagingService->send($pushable, $langId, $serverKey, $chunkedPushUsers);
                }
            }
        }
    }

}

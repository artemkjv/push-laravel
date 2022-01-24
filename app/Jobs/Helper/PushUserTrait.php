<?php


namespace App\Jobs\Helper;


use App\Events\PushSent;
use App\Libraries\Firebase\MessagingService;
use App\Models\Pushable;
use App\Models\SentPush;
use Illuminate\Support\Facades\App;
use Ramsey\Collection\Collection;

trait PushUserTrait
{

    public function send($pushUsers, Pushable $pushable){
        $messagingService = App::make(MessagingService::class);
        $sortedArray = [];
        foreach($pushUsers as $pushUser){
            $sortedArray[$pushUser->app->server_key][$pushUser->language->id][] = $pushUser;
        }
        if(count($sortedArray) > 0){
            $sentPush = $this->createSentPush($pushable, $pushUsers);
            foreach ($sortedArray as $serverKey => $languages){
                foreach ($languages as $langId => $pushUsers){
                    $chunkedArray = array_chunk($pushUsers, 1000);
                    foreach ($chunkedArray as $chunkedPushUsers){
                        $messagingService->send($pushable, $langId, $serverKey, collect($chunkedPushUsers), $sentPush);
                    }
                }
            }
        }
    }

    private function createSentPush(Pushable $pushable, $pushUsers){
        return SentPush::create([
            'pushable_id' => $pushable->getId(),
            'pushable_type' => get_class($pushable),
            'sent' => count($pushUsers),
            'clicked' => 0,
            'user_id' => $pushable->getUser()->id,
            'title' => $pushable->getTitle(),
            'body' => $pushable->getBody(),
            'image' => $pushable->getImage(),
            'icon' => $pushable->getIcon(),
            'open_url' => $pushable->getOpenUrl(),
            'deeplink' => $pushable->getDeeplink(),
            'sound' => $pushable->getSound()
        ]);
    }

}

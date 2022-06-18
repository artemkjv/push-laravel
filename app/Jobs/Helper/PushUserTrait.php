<?php


namespace App\Jobs\Helper;


use App\Events\PushSent;
use App\Libraries\Firebase\MessagingService;
use App\Models\Pushable;
use App\Models\SentPush;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

trait PushUserTrait
{

    public function send($pushUsers, Pushable $pushable){
        $apnsPushUsers = $pushUsers->where('platform_id', 2);
        $fcmPushUsers = $pushUsers->where('platform_id', '!=', 2);
        $this->sendFcmUsers($fcmPushUsers, $pushable);
        $this->sendApnsUsers($apnsPushUsers, $pushable);
    }

    private function sendFcmUsers(Collection $pushUsers, Pushable $pushable){
        $messagingService = App::make(MessagingService::class);
        $sortedArray = [];
        foreach($pushUsers as $pushUser){
            $sortedArray[$pushUser->app->server_key][$pushUser->language->id][] = $pushUser;
        }
        if(count($sortedArray) > 0){
            $sentPush = $this->createSentPush($pushable, count($pushUsers));
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

    private function sendApnsUsers(Collection $pushUsers, Pushable $pushable) {
        if($pushUsers->count() > 0) {
            $sentPush = $this->createSentPush($pushable, $pushUsers->count());
            $messagingService = App::make(\App\Libraries\APNS\MessagingService::class);
            $appsPushUsers = $pushUsers->groupBy('app_id');
            foreach ($appsPushUsers as $appPushUsers) {
                $pushUser = $appPushUsers->first();
                $certificate = Storage::path($pushUser->app->certificate);
                $password = $pushUser->app->private_key;
                $bundle = $pushUser->app->title;
                $languagesPushUsers = $appPushUsers->groupBy('language_id');
                foreach ($languagesPushUsers as $languageId => $languagePushUsers) {
                    $chunksPushUsers = $languagePushUsers->chunk(1000);
                    foreach ($chunksPushUsers as $chunksPushUser) {
                        $messagingService->send($pushable, $languageId, $bundle, $certificate, $password, $chunksPushUser, $sentPush);
                    }
                }
            }
        }
    }


    private function createSentPush(Pushable $pushable, $pushUsersQuantity){
        return SentPush::create([
            'pushable_id' => $pushable->getId(),
            'pushable_type' => get_class($pushable),
            'sent' => $pushUsersQuantity,
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

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

    public function send($pushUsers, Pushable $pushable)
    {
        $androidPushUsers = $pushUsers->where('platform_id', 1);
        $iosPushUsers = $pushUsers->where('platform_id', 2);
        $webPushUsers = $pushUsers->where('platform_id', 3);
        $this->sendAndroidUsers($androidPushUsers, $pushable);
        $this->sendIosUsers($iosPushUsers, $pushable);
        $this->sendWebUsers($webPushUsers, $pushable);
    }

    private function sendWebUsers(Collection $pushUsers, Pushable $pushable) {
        if($pushUsers->count()) {
            $sentPush = $this->createSentPush($pushable, $pushUsers->count());
            $safariUsers = $pushUsers->where('is_safari', true);
            $fcmUsers = $pushUsers->where('is_safari', false);
            $this->sendAndroidUsers($fcmUsers, $pushable);

            if($safariUsers->count() > 0) {
                $appsPushUsers = $safariUsers->groupBy('app_id');

                foreach ($appsPushUsers as $appPushUsers) {
                    $messagingService = App::make(\App\Libraries\APNS\MessagingService::class);
                    $pushUser = $appPushUsers->first();
                    $certificate = Storage::path($pushUser->app->web_certificate);
                    $password = $pushUser->app->web_private_key;
                    $languagesPushUsers = $appPushUsers->groupBy('language_id');
                    foreach ($languagesPushUsers as $languageId => $languagePushUsers) {
                        $chunksPushUsers = $languagePushUsers->chunk(1000);

                        foreach ($chunksPushUsers as $chunksPushUser) {
                            $messagingService->send($pushable, $languageId, null, $certificate, $password, $chunksPushUser, $sentPush, true);
                        }

                    }

                }

            }

        }
    }

    private function sendAndroidUsers(Collection $pushUsers, Pushable $pushable)
    {
        if ($pushUsers->count() > 0) {
            $sentPush = $this->createSentPush($pushable, $pushUsers->count());
            $messagingService = App::make(MessagingService::class);
            $sortedArray = [];
            foreach ($pushUsers as $pushUser) {
                $sortedArray[$pushUser->app->server_key][$pushUser->language->id][] = $pushUser;
            }
            foreach ($sortedArray as $serverKey => $languages) {
                foreach ($languages as $langId => $pushUsers) {
                    $chunkedArray = array_chunk($pushUsers, 1000);
                    foreach ($chunkedArray as $chunkedPushUsers) {
                        $messagingService->send($pushable, $langId, $serverKey, collect($chunkedPushUsers), $sentPush);
                    }
                }
            }
        }
    }

    private function sendIosUsers(Collection $pushUsers, Pushable $pushable)
    {
        if ($pushUsers->count() > 0) {
            $sentPush = $this->createSentPush($pushable, $pushUsers->count());
            $messagingService = App::make(\App\Libraries\APNS\MessagingService::class);
            $appsPushUsers = $pushUsers->groupBy('app_id');
            foreach ($appsPushUsers as $appPushUsers) {
                $pushUser = $appPushUsers->first();
                $certificate = Storage::path($pushUser->app->certificate);
                $password = $pushUser->app->private_key;
                $bundle = $pushUser->app->bundle;
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


    private function createSentPush(Pushable $pushable, $pushUsersQuantity)
    {
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

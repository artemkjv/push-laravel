<?php

namespace App\Libraries\APNS;

use App\Models\Pushable;
use App\Models\PushUser;
use App\Models\SentPush;
use App\Repositories\PushUserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Pushok\AuthProvider\Certificate;
use Pushok\Client;
use Pushok\Notification;
use Pushok\Payload;
use Pushok\Payload\Alert;

class MessagingService
{


    private PushUserRepositoryInterface $pushUserRepository;

    public function __construct(PushUserRepositoryInterface $pushUserRepository)
    {
        $this->pushUserRepository = $pushUserRepository;
    }


    public function send(Pushable $pushable, $languageId, $bundle, $certificate, $password, Collection $pushUsers, SentPush $sentPush){
        $data = $this->parseData($pushable, $languageId, $sentPush);
        $inactiveTokens = [];
        $notifications = [];
        $options = [
            'app_bundle_id' => $bundle,
            'certificate_path' => $certificate,
            'certificate_secret' => $password,
        ];
        $authProvider = Certificate::create($options);
        $client = new Client($authProvider, $production = true);
        $client->setNbConcurrentRequests( 40 );
        $client->setMaxConcurrentConnections( 5 );
        foreach ($pushUsers as $pushUser) {
            echo 'push-user-id: ' . $pushUser->id;
            $notifications[] = new Notification($data, $pushUser->registration_id);
        }
        $client->addNotifications($notifications);
        try {
            $responses = $client->push();
            foreach ($responses as $response) {
                if($response->getStatusCode() !== 200){
                    echo 'error: ' . $response->getErrorDescription();
                    $inactiveTokens[] = $response->getDeviceToken();
                }
            }
        } catch (\Exception $e) { echo $e->getMessage(); }
        $this->pushUserRepository->updateByRegistrationIds($inactiveTokens, ['status' => PushUser::UNSUBSCRIBED_STATUS]);
    }

    private function parseData(Pushable $pushable, $languageId, SentPush $sentPush){
        $title = $pushable->getTitle()[$languageId] ?? $pushable->getTitle()[1];
        $body = $pushable->getBody()[$languageId] ?? $pushable->getBody()[1];
        $alert = Alert::create()
            ->setTitle($title)
            ->setBody($body);
        $image = $pushable->getImage() ?: asset("/storage/{$pushable->getImage()}");
        if($image) {
            $alert->setLaunchImage($image);
        }
        return Payload::create()->setAlert($alert)
            ->setCustomValue('link_url', $pushable->getOpenUrl())
            ->setCustomValue('deeplink', $pushable->getDeeplink())
            ->setCustomValue('sent_push_id', $sentPush->id)
            ->setCustomValue('push_id', $pushable->getId())
            ->setCustomValue('time_to_live', $pushable->getTimeToLive())
            ->setCustomValue('push_type', get_class($pushable));
    }

}

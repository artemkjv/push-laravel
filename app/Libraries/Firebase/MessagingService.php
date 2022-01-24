<?php


namespace App\Libraries\Firebase;


use App\Models\App;
use App\Models\Pushable;
use App\Models\SentPush;
use App\Repositories\PushUserRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class MessagingService
{
    private PushUserRepositoryInterface $pushUserRepository;
    private const FIREBASE_URL = 'https://fcm.googleapis.com/fcm/';
    private Client $client;

    public function __construct(
        PushUserRepositoryInterface $pushUserRepository,
    )
    {
        $this->pushUserRepository = $pushUserRepository;
        $this->client = new Client([
            'base_uri' => self::FIREBASE_URL
        ]);
    }


    public function send(Pushable $pushable, $languageId, $serverKey, Collection $pushUsers, SentPush $sentPush){
        $data = $this->parseData($pushable, $languageId, $pushUsers, $sentPush);
        try {
            $response = $this->client->request("POST", 'send', [
                'headers' => [
                    'Authorization' => 'key=' . $serverKey
                ],
                'json' => $data
            ]);
            $result = json_decode($response->getBody()->getContents(),true);
            if($result['failure']){
                $sentFailures = [];
                foreach ($result['results'] as $key => $sentResult){
                    if(isset($sentResult['error'])){
                        $pushUser = $pushUsers[$key];
                        $sentFailures[] = $pushUser;
                    }
                }
                \DB::beginTransaction();
                foreach ($sentFailures as $pushUser){
                    $pushUser->status = 'UNSUBSCRIBED';
                    $pushUser->update();
                }
                \DB::commit();
            }
        } catch (\Throwable $e){
            echo $e->getMessage();
        }

    }

    private function parseData(Pushable $pushable, $languageId, Collection $pushUsers, SentPush $sentPush){
        $title = $pushable->getTitle()[$languageId] ?? $pushable->getTitle()[1];
        $body = $pushable->getBody()[$languageId] ?? $pushable->getBody()[1];
        $registrationIds = $pushUsers->pluck('registration_id');
        return [
            'registration_ids' => $registrationIds,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'image' => $pushable->getIcon() ? asset("/storage/{$pushable->getIcon()}") : null,
                'time_to_live' => $pushable->getTimeToLive()
            ],
            'data' => [
                'open_url' => $pushable->getOpenUrl(),
                'deeplink' => $pushable->getDeeplink(),
                'title' => $title,
                'body' => $body,
                'sent_push_id' => $sentPush->id,
                'image' => $pushable->getImage() ? asset("/storage/{$pushable->getImage()}") : null,
                'icon' => $pushable->getIcon() ? asset("/storage/{$pushable->getIcon()}") : null,
                'push_id' => $pushable->getId(),
                'push_type' => get_class($pushable)
            ]
        ];
    }

}

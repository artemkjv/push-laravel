<?php


namespace App\Libraries\Firebase;


use App\Models\App;
use App\Models\Pushable;
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


    public function send(Pushable $pushable, $languageId, $serverKey, Collection $pushUsers){
        $data = $this->parseData($pushable, $languageId, $pushUsers);
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
                        $pushUser->status = 'UNSUBSCRIBED';
                        $sentFailures[] = $pushUser;
                    }
                }
                \DB::transaction(function () use ($sentFailures){
                    foreach ($sentFailures as $pushUser)
                        $this->pushUserRepository->save($pushUser);
                });
            }
        } catch (\Throwable $e){
            echo $e->getMessage();
        }

    }

    private function parseData(Pushable $pushable, $languageId, Collection $pushUsers){
        $title = $pushable->getTitle()[$languageId] ?? $pushable->getTitle()[1];
        $body = $pushable->getBody()[$languageId] ?? $pushable->getBody()[1];
        $registrationIds = $pushUsers->pluck('registration_id');
        return [
            'registration_ids' => $registrationIds,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'image' => $pushable->getIcon() ? config('app.url') .  asset("/storage/{$pushable->getIcon()}") : null,
                'time_to_live' => $pushable->getTimeToLive()
            ],
            'data' => [
                'open_url' => $pushable->getOpenUrl(),
                'title' => $title,
                'body' => $body,
                'image' => $pushable->getImage() ? config('app.url') .  asset("/storage/{$pushable->getImage()}") : null,
                'icon' => $pushable->getIcon() ? config('app.url') .  asset("/storage/{$pushable->getIcon()}") : null,
                'push_id' => $pushable->getId(),
                'push_type' => get_class($pushable)
            ]
        ];
    }

}

<?php

namespace App\Libraries\Safari;

use App\Models\Pushable;
use App\Models\PushUser;
use App\Models\SentPush;
use App\Repositories\PushUserRepositoryInterface;
use Illuminate\Support\Collection;
use Pushok\AuthProvider\Certificate;

class MessagingService
{


    private PushUserRepositoryInterface $pushUserRepository;

    public function __construct(PushUserRepositoryInterface $pushUserRepository)
    {
        $this->pushUserRepository = $pushUserRepository;
    }


    public function send(
        Pushable $pushable, $languageId,
        $certificate, $password,
        Collection $pushUsers,
        SentPush $sentPush, $urlArgs
    ){
        $data = $this->parseData($pushable, $languageId, $sentPush);
        $inactiveTokens = [];

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $certificate);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $password);

        $fp = stream_socket_client(
            'ssl://gateway.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            echo "Failed to connect: $err $errstr";
        else {
            foreach ($pushUsers as $pushUser) {
                $payload = json_encode([
                    'aps' => [
                        'alert' => [
                            'title' => $data['title'],
                            'body' => $data['body'],
                            'action' => 'Details'
                        ],
                        'url-args' => $urlArgs
                    ]
                ]);
                $msg = chr(0) . pack('n', 32) . pack('H*', $pushUser->registration_id) . pack('n', strlen($payload)) . $payload;
                $result = fwrite($fp, $msg, strlen($msg));
                echo('Push SAFARI send successfully; result ' . $result . ' Sent message: "' . $payload . '";');
            }
            fclose($fp);
        }
        $this->pushUserRepository->updateByRegistrationIds($inactiveTokens, ['status' => PushUser::UNSUBSCRIBED_STATUS]);
    }

    private function parseData(Pushable $pushable, $languageId, SentPush $sentPush){
        $title = $pushable->getTitle()[$languageId] ?? $pushable->getTitle()[1];
        $body = $pushable->getBody()[$languageId] ?? $pushable->getBody()[1];
        $payload = [
            'title' => $title,
            'body' => $body
        ];
        return $payload;
    }

}

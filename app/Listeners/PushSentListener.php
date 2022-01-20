<?php

namespace App\Listeners;

use App\Events\PushSent;
use App\Repositories\SentPushRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PushSentListener
{
    private SentPushRepositoryInterface $sentPushRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        SentPushRepositoryInterface $sentPushRepository
    )
    {
        $this->sentPushRepository = $sentPushRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PushSent $event)
    {
        if(!$event->stats){
            $user = $event->pushable->getUser();
            try {
                $sentPush = $this->sentPushRepository->getLastByPushableTypeAndUser(get_class($event->pushable), $user);
                $sentPush->sent += $event->sent;
                $sentPush->save();
                return;
            } catch (\Throwable $exception){}
        }
        $data = [
            'pushable_id' => $event->pushable->getId(),
            'pushable_type' => get_class($event->pushable),
            'sent' => $event->sent,
            'clicked' => 0,
            'user_id' => $event->pushable->getUser()->id,
            'title' => $event->pushable->getTitle(),
            'body' => $event->pushable->getBody(),
            'image' => $event->pushable->getImage(),
            'icon' => $event->pushable->getIcon(),
            'open_url' => $event->pushable->getOpenUrl(),
            'deeplink' => $event->pushable->getDeeplink(),
            'sound' => $event->pushable->getSound()
        ];
        $this->sentPushRepository->save($data);
    }
}

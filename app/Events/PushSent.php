<?php

namespace App\Events;

use App\Models\Pushable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PushSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Pushable $pushable;
    public int $sent;
    public bool $stats;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pushable $pushable, int $sent, bool $stats)
    {
        $this->pushable = $pushable;
        $this->sent = $sent;
        $this->stats = $stats;
    }

}

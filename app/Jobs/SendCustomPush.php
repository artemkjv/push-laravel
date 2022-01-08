<?php

namespace App\Jobs;

use App\Jobs\Helper\PushUserTrait;
use App\Models\CustomPush;
use App\Models\Timezone;
use App\Repositories\PushUserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class SendCustomPush implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PushUserTrait;

    private CustomPush $customPush;
    private \DateTime $oldTimeToSend;
    private Timezone $timezone;
    private PushUserRepositoryInterface $pushUserRepository;

    /**
     * Create a new job instance.
     *
     * @param CustomPush $customPush
     * @param Timezone $timezone
     */
    public function __construct(CustomPush $customPush, Timezone $timezone)
    {
        $this->customPush = $customPush;
        $this->oldTimeToSend = $customPush->getTimeToSend();
        $this->pushUserRepository = App::make(PushUserRepositoryInterface::class);
        $this->timezone = $timezone;
        $this->onQueue('send-custom-push');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->customPush->getTimeToSend() != $this->oldTimeToSend) return;
        $apps = $this->customPush->apps;
        $segments = $this->customPush->segments;
        $pushUsers = $this->pushUserRepository->getByAppsAndSegmentsAndTimezone($apps, $segments, $this->timezone);
        $this->send($pushUsers, $this->customPush);
    }
}

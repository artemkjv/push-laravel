<?php

namespace App\Jobs;

use App\Jobs\Helper\PushUserTrait;
use App\Libraries\Firebase\MessagingService;
use App\Models\Timezone;
use App\Models\WeeklyPush;
use App\Repositories\PushUserRepositoryInterface;
use Carbon\Traits\Week;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class SendWeeklyPush implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PushUserTrait;

    private WeeklyPush $weeklyPush;
    private MessagingService $messagingService;
    private $oldTimeToSend;
    private Timezone $timezone;
    private PushUserRepositoryInterface $pushUserRepository;

    /**
     * Create a new job instance.
     *
     * @param WeeklyPush $weeklyPush
     * @param Timezone $timezone
     */
    public function __construct(WeeklyPush $weeklyPush, Timezone $timezone)
    {
        $this->weeklyPush = $weeklyPush;
        $this->timezone = $timezone;
        $this->oldTimeToSend = $weeklyPush->getTimeToSend();
        $this->pushUserRepository = App::make(PushUserRepositoryInterface::class);
        $this->messagingService = App::make(MessagingService::class);
        $this->onQueue('send-weekly-push');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->weeklyPush->getTimeToSend() !== $this->oldTimeToSend) return;
        $apps = $this->weeklyPush->apps;
        $segments = $this->weeklyPush->segments;
        $pushUsers = $this->pushUserRepository->getByAppsAndSegmentsAndTimezone($apps, $segments, $this->timezone);
        $this->send($pushUsers, $this->weeklyPush);
    }
}

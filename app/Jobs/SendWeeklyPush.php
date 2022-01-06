<?php

namespace App\Jobs;

use App\Libraries\Firebase\MessagingService;
use App\Models\WeeklyPush;
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
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private WeeklyPush $weeklyPush;
    private MessagingService $messagingService;
    private $oldTimeToSend;

    /**
     * Create a new job instance.
     *
     * @param WeeklyPush $weeklyPush
     */
    public function __construct(WeeklyPush $weeklyPush)
    {
        $this->weeklyPush = $weeklyPush;
        $this->oldTimeToSend = $weeklyPush->getTimeToSend();
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
        $this->messagingService->send($this->weeklyPush);
    }
}

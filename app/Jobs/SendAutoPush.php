<?php

namespace App\Jobs;

use App\Libraries\Firebase\MessagingService;
use App\Models\AutoPush;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class SendAutoPush implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private AutoPush $autoPush;
    private MessagingService $messagingService;

    /**
     * Create a new job instance.
     *
     * @param AutoPush $autoPush
     */
    public function __construct(AutoPush $autoPush)
    {
        $this->autoPush = $autoPush;
        $this->messagingService = App::make(MessagingService::class);
        $this->onQueue('send-auto-push');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->messagingService->send($this->autoPush);
    }
}

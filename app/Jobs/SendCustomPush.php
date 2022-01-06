<?php

namespace App\Jobs;

use App\Libraries\Firebase\MessagingService;
use App\Models\CustomPush;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Output\ConsoleOutput;

class SendCustomPush implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private CustomPush $customPush;
    private MessagingService $messagingService;
    private \DateTime $oldTimeToSend;

    /**
     * Create a new job instance.
     *
     * @param CustomPush $customPush
     */
    public function __construct(CustomPush $customPush)
    {
        $this->customPush = $customPush;
        $this->oldTimeToSend = $customPush->getTimeToSend();
        $this->messagingService = App::make(MessagingService::class);
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
        $this->messagingService->send($this->customPush);
    }
}

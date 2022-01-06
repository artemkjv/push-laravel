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

    /**
     * Create a new job instance.
     *
     * @param CustomPush $customPush
     * @param MessagingService $messagingService
     */
    public function __construct(CustomPush $customPush)
    {
        $this->customPush = $customPush;
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
        $this->messagingService->send($this->customPush);
    }
}

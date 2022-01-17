<?php

namespace App\Jobs;

use App\Jobs\Helper\PushUserTrait;
use App\Models\AutoPush;
use App\Repositories\PushUserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class SendAutoPush implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PushUserTrait;

    private AutoPush $autoPush;
    private $pushUserRepository;
    private mixed $oldIntervalUpdatedAt;

    /**
     * Create a new job instance.
     *
     * @param AutoPush $autoPush
     */
    public function __construct(AutoPush $autoPush)
    {
        $this->autoPush = $autoPush;
        $this->oldIntervalUpdatedAt = $autoPush->interval_updated_at;
        $this->pushUserRepository = App::make(PushUserRepositoryInterface::class);
        $this->onQueue('send-auto-push');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->oldIntervalUpdatedAt !== $this->autoPush->interval_updated_at) return;
        if($this->autoPush->status === 'ACTIVE'){
            $apps = $this->autoPush->apps;
            $segments = $this->autoPush->segments;
            $pushUsers = $this->pushUserRepository->getByAppsAndSegments($apps, $segments);
            $this->send($pushUsers, $this->autoPush);
        }
        SendAutoPush::dispatch($this->autoPush)->delay($this->autoPush->getTimeToSend());
    }
}

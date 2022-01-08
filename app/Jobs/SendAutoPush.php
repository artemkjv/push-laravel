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
    private $oldIntervalType;
    private $oldIntervalValue;
    private $pushUserRepository;

    /**
     * Create a new job instance.
     *
     * @param AutoPush $autoPush
     */
    public function __construct(AutoPush $autoPush)
    {
        $this->autoPush = $autoPush;
        $this->oldIntervalType = $autoPush->interval_type;
        $this->oldIntervalValue = $autoPush->interval_value;
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
        if($this->autoPush->interval_type !== $this->oldIntervalType
            || $this->autoPush->interval_value !== $this->oldIntervalValue) return;
        $apps = $this->autoPush->apps;
        $segments = $this->autoPush->segments;
        $pushUsers = $this->pushUserRepository->getByAppsAndSegmentsAndTimezone($apps, $segments);
        $this->send($pushUsers, $this->autoPush);
        SendAutoPush::dispatch($this->autoPush)->delay($this->autoPush->getTimeToSend());
    }
}

<?php

namespace App\Jobs;

use App\Jobs\Helper\PushUserTrait;
use App\Models\PushUser;
use App\Repositories\AutoPushRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class CreatedPushUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PushUserTrait;

    private PushUser $pushUser;
    private AutoPushRepositoryInterface $autoPushRepository;

    /**
     * Create a new job instance.
     *
     * @param PushUser $pushUser
     */
    public function __construct(PushUser $pushUser)
    {
        $this->pushUser = $pushUser;
        $this->autoPushRepository = App::make(AutoPushRepositoryInterface::class);
        $this->onQueue('created-push-user');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $autoPushes = $this->autoPushRepository
            ->getBySegmentsAndApp($this->pushUser->segments, $this->pushUser->app);
        foreach ($autoPushes as $autoPush){
            $this->send([$this->pushUser], $autoPush);
        }
    }
}

<?php

namespace App\Jobs;

use App\Models\App;
use App\Models\Segment;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SegmentPushUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Segment $segment;
    private PushUserRepositoryInterface $pushUserRepository;
    private SegmentRepositoryInterface $segmentRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Segment $segment)
    {
        $this->segment = $segment;
        $this->segmentRepository = \App::make(SegmentRepositoryInterface::class);
        $this->pushUserRepository = \App::make(PushUserRepositoryInterface::class);
        $this->onQueue('segment-push-users');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $apps = $this->segment->user->apps;
        try {
            $pushUsers = $this->pushUserRepository->getNotRelatedWithSegmentByApps($this->segment, $apps);
            $this->segment->pushUsers()->sync($pushUsers);
        } catch (\Throwable $e){
            echo $e->getMessage();
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Jobs\SegmentPushUserJob;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use Illuminate\Console\Command;

class PushUserSegment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pushUser:segment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command to relate push users with segments.';
    private PushUserRepositoryInterface $pushUserRepository;
    private SegmentRepositoryInterface $segmentRepository;

    /**
     * Create a new command instance.
     *
     * @param SegmentRepositoryInterface $segmentRepository
     * @param PushUserRepositoryInterface $pushUserRepository
     */
    public function __construct(
        SegmentRepositoryInterface $segmentRepository,
        PushUserRepositoryInterface $pushUserRepository
    )
    {
        parent::__construct();
        $this->pushUserRepository = $pushUserRepository;
        $this->segmentRepository = $segmentRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $segments = $this->segmentRepository->getAll();
        foreach ($segments as $segment){
            SegmentPushUserJob::dispatch($segment);
        }
        return 1;
    }
}

<?php

namespace App\Jobs;

use App\Models\CustomPush;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteExcelPush implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private CustomPush $customPush;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CustomPush $customPush)
    {
        $this->customPush = $customPush;
        $this->onQueue('delete-excel-push');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->customPush->segments()->delete();
        $this->customPush->delete();
    }
}

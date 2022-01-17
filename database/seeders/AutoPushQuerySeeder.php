<?php

namespace Database\Seeders;

use App\Jobs\SendAutoPush;
use App\Models\AutoPush;
use Illuminate\Database\Seeder;

class AutoPushQuerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $autoPushes = AutoPush::all();
        foreach ($autoPushes as $autoPush){
            SendAutoPush::dispatch($autoPush);
        }
    }
}

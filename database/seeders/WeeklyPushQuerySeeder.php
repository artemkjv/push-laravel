<?php

namespace Database\Seeders;

use App\Jobs\SendWeeklyPush;
use App\Models\Timezone;
use App\Models\WeeklyPush;
use Illuminate\Database\Seeder;

class WeeklyPushQuerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weeklyPushes = WeeklyPush::all();
        foreach($weeklyPushes as $weeklyPush){
            $timezones = Timezone::all();
            foreach ($timezones as $timezone){
                $datetime = $weeklyPush->getTimeToSend($timezone->name);
                SendWeeklyPush::dispatch($weeklyPush, $timezone)->delay($datetime);
            }
        }
    }
}

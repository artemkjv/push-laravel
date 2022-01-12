<?php

namespace App\Observers;

use App\Jobs\SendWeeklyPush;
use App\Libraries\Helpers\DateTimeHelper;
use App\Models\WeeklyPush;
use App\Repositories\TimezoneRepositoryInterface;

class WeeklyPushObserver
{

    private TimezoneRepositoryInterface $timezoneRepository;

    public function __construct(TimezoneRepositoryInterface $timezoneRepository)
    {
        $this->timezoneRepository = $timezoneRepository;
    }

    public function saving(WeeklyPush $weeklyPush){
        $currentUser = request()->user();
        $weeklyPush->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
        $weeklyPush->user_modified_id = $currentUser->id;
        if($weeklyPush->getOriginal('days_to_send') !== $weeklyPush->interval_value
            || $weeklyPush->getOriginal('time_to_send') !== $weeklyPush->time_to_send){
            $weeklyPush->time_to_send_updated_at = (new \DateTime())->format('Y-m-d H:i:s');
        }
    }

    public function saved(WeeklyPush $weeklyPush){
        if($weeklyPush->getOriginal('days_to_send') !== $weeklyPush->interval_value
            || $weeklyPush->getOriginal('time_to_send') !== $weeklyPush->time_to_send){
            $timezones = $this->timezoneRepository->getAll();
            foreach ($timezones as $timezone){
                $datetime = $weeklyPush->getTimeToSend($timezone->name);
                SendWeeklyPush::dispatch($weeklyPush, $timezone)->delay($datetime);
            }
        }
    }

}

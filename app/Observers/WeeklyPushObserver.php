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
    }

    public function saved(WeeklyPush $weeklyPush){
        if($weeklyPush->getOriginal('days_to_send') !== $weeklyPush->interval_value
            || $weeklyPush->getOriginal('time_to_send') !== $weeklyPush->time_to_send){
            $timezones = $this->timezoneRepository->getAll();
            $timeToSend = new \DateTimeImmutable($weeklyPush->time_to_send);
            $utcTimezone = new \DateTimeZone('UTC');
            foreach ($timezones as $timezone){
                foreach ($weeklyPush->days_to_send as $day){
                    $datetime = new \DateTime('NOW', new \DateTimeZone($timezone->name));
                    $datetime->modify("next $day");
                    $datetime->setTime(
                        $timeToSend->format('H'),
                        $timeToSend->format('i')
                    );
                    $datetime->setTimezone($utcTimezone);
                    $sendDates[] = $datetime;
                }
                $datetime = DateTimeHelper::instance()->getClosestDate($sendDates);
                SendWeeklyPush::dispatch($weeklyPush)->delay($datetime);
            }
        }
    }

}

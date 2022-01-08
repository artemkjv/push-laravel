<?php

namespace App\Observers;

use App\Jobs\SendCustomPush;
use App\Models\CustomPush;
use App\Repositories\TimezoneRepositoryInterface;

class CustomPushObserver
{

    private TimezoneRepositoryInterface $timezoneRepository;

    public function __construct(TimezoneRepositoryInterface $timezoneRepository)
    {
        $this->timezoneRepository = $timezoneRepository;
    }

    public function saving(CustomPush $customPush){
        $currentUser = request()->user();
        $customPush->user_id = $currentUser->admin ? $currentUser->admin->id : $currentUser->id;
        $customPush->user_modified_id = $currentUser->id;
    }

    public function saved(CustomPush $customPush){
        if($customPush->getOriginal('time_to_send') !==
            (new \DateTime($customPush->time_to_send))->format('Y-m-d H:i:s')){
            $timezones = $this->timezoneRepository->getAll();
            foreach ($timezones as $timezone){
                $timeToSend = $customPush->getTimeToSend($timezone->name);
                if($timeToSend > new \DateTime()){
                    SendCustomPush::dispatch($customPush, $timezone)->delay($timeToSend);
                    continue;
                }
                SendCustomPush::dispatch($customPush, $timezone);
            }
        }
    }

}

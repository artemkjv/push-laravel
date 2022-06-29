<?php

namespace App\Observers;

use App\Http\Requests\Api\ExcelCustomPushRequest;
use App\Jobs\DeleteExcelPush;
use App\Jobs\ExcelCustomPush;
use App\Jobs\SendCustomPush;
use App\Libraries\Decoration\ModeratorWrapper;
use App\Models\CustomPush;
use App\Repositories\TimezoneRepositoryInterface;
use Carbon\Carbon;

class CustomPushObserver
{

    private TimezoneRepositoryInterface $timezoneRepository;

    public function __construct(TimezoneRepositoryInterface $timezoneRepository)
    {
        $this->timezoneRepository = $timezoneRepository;
    }

    public function saving(CustomPush $customPush){
        $currentUser = request()->user();
        $customPush->user_modified_id = $currentUser->id;
        if($customPush->getOriginal('time_to_send') !==
            (new \DateTime($customPush->time_to_send))->format('Y-m-d H:i:s')){
            $customPush->time_to_send_updated_at = (new \DateTime())->format('Y-m-d H:i:s');
        }
    }

    public function saved(CustomPush $customPush){
        if($customPush->getOriginal('time_to_send') !==
            (new \DateTime($customPush->time_to_send))->format('Y-m-d H:i:s')){
            if(\request()->route()->getName() === 'api.customPush.excel') {

                if($customPush->getTimeToSend() > new \DateTime()){
                    DeleteExcelPush::dispatch($customPush)->delay(
                        $customPush->getTimeToSend()->add(new \DateInterval('P1D'))
                    );
                } else {
                    DeleteExcelPush::dispatch($customPush)
                        ->delay(Carbon::now()->addDay());
                }

            }
            $timezones = $this->timezoneRepository->getAll();
            foreach ($timezones as $timezone){
                $timeToSend = $customPush->getTimeToSend($timezone->name);
                if($timeToSend > new \DateTime()){

                    if(\request()->route()->getName() === 'api.customPush.excel') {
                        ExcelCustomPush::dispatch($customPush, $timezone)->delay($timeToSend);

                    } else {
                        SendCustomPush::dispatch($customPush, $timezone)->delay($timeToSend);
                    }

                    continue;
                }

                if(\request()->route()->getName() === 'api.customPush.excel') {
                    // Delay for ten minutes because we need to synchronize segment (if the payload contains country_id or tag)
                    ExcelCustomPush::dispatch($customPush, $timezone)
                        ->delay(Carbon::now()->addMinutes(10));
                }
                else {
                    SendCustomPush::dispatch($customPush, $timezone);
                }
            }
        }
    }

    public function creating(CustomPush $customPush){
        $currentUser = request()->currentUser ?? request()->user();
        $customPush->user_id = $currentUser->role === config('roles.moderator') ? $currentUser->admin->id : $currentUser->id;
    }

    public function created(CustomPush $customPush){
        $currentUser = request()->user();
        if($currentUser->role === config('roles.moderator')){
            $moderatorWrapper = new ModeratorWrapper($currentUser);
            $moderatorWrapper->customPushes()->attach($customPush);
        }
    }

}

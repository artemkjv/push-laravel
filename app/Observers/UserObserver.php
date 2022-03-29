<?php

namespace App\Observers;

use App\Models\Tariff;
use App\Models\User;
use App\Repositories\TariffRepositoryInterface;

class UserObserver
{

    private TariffRepositoryInterface $tariffRepository;

    public function __construct(
        TariffRepositoryInterface $tariffRepository
    )
    {
        $this->tariffRepository = $tariffRepository;
    }

    public function saving(User $user){
        $user->last_ip = request()->ip();
        $user->last_login_at = new \DateTime();
    }

    public function creating(User $user){
        if($user->role === config('roles.moderator')){
            $user->admin_id = request()->user()->id;
        } else if($user->role === config('roles.user')){
            $tariff = $this->tariffRepository->getDefault();
            $user->tariff()->associate($tariff);
        }
    }

}

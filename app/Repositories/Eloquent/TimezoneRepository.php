<?php


namespace App\Repositories\Eloquent;


use App\Models\Timezone;
use App\Repositories\TimezoneRepositoryInterface;

class TimezoneRepository implements TimezoneRepositoryInterface
{

    public function getByName(string $name)
    {
        Timezone::where('name', $name)
            ->firstOrFail();
    }
}

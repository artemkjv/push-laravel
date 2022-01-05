<?php


namespace App\Repositories\Eloquent;


use App\Models\Timezone;
use App\Repositories\TimezoneRepositoryInterface;

class TimezoneRepository implements TimezoneRepositoryInterface
{

    public function getByName(string $name)
    {
        return Timezone::where('name', $name)
            ->firstOrFail();
    }

    public function getAll()
    {
        return Timezone::all();
    }
}

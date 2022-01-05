<?php


namespace App\Repositories\Eloquent;


use App\Models\Country;
use App\Repositories\CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{

    public function getByCode(string $code)
    {
        return Country::where('code', $code)
            ->firstOrFail();
    }
}

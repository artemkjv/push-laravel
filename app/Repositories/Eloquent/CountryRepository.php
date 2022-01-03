<?php


namespace App\Repositories\Eloquent;


use App\Models\Country;
use App\Repositories\CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{

    public function getByCode(string $code)
    {
        Country::where('code', $code)
            ->firstOrFail();
    }
}

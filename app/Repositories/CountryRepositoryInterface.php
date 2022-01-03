<?php


namespace App\Repositories;


interface CountryRepositoryInterface
{

    public function getByCode(string $code);

}

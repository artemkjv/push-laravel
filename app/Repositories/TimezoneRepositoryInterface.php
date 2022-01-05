<?php


namespace App\Repositories;


interface TimezoneRepositoryInterface
{

    public function getByName(string $name);

    public function getAll();

}

<?php

namespace App\Repositories;

interface FilterTypeRepositoryInterface
{

    public function getAll();

    public function getById(int $id);

}

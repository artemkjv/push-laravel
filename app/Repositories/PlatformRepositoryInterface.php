<?php

namespace App\Repositories;

interface PlatformRepositoryInterface
{

    public function getAll();

    public function getByName(string $name);

}

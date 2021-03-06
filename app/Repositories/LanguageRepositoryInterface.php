<?php

namespace App\Repositories;

interface LanguageRepositoryInterface
{

    public function getAll();

    public function getByCode(string $code);

}

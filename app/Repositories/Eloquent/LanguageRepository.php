<?php

namespace App\Repositories\Eloquent;

use App\Models\Language;
use App\Repositories\LanguageRepositoryInterface;

class LanguageRepository implements LanguageRepositoryInterface
{

    public function getAll()
    {
        return Language::all();
    }

    public function getByCode(string $code)
    {
        return Language::where('code', $code)
            ->firstOrFail();
    }
}

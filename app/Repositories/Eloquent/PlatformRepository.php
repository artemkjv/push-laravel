<?php

namespace App\Repositories\Eloquent;

use App\Models\Platform;
use App\Repositories\PlatformRepositoryInterface;

class PlatformRepository implements PlatformRepositoryInterface
{

    public function getAll()
    {
        return Platform::all();
    }

    public function getByName(string $name)
    {
        return Platform::query()
            ->where('name', $name)
            ->firstOrFail();
    }
}

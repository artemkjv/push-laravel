<?php

namespace App\Repositories\Eloquent;

use App\Models\Filter;
use App\Repositories\FilterRepositoryInterface;

class FilterRepository implements FilterRepositoryInterface
{
    public function save($data)
    {
        return Filter::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }
}

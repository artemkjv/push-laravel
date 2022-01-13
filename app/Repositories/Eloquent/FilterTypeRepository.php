<?php

namespace App\Repositories\Eloquent;

use App\Models\FilterType;
use App\Repositories\FilterTypeRepositoryInterface;

class FilterTypeRepository implements FilterTypeRepositoryInterface
{

    public function getAll()
    {
        return FilterType::with('predicates')
            ->get();
    }

    public function getById(int $id)
    {
        return FilterType::with('predicates')
            ->where('id', $id)
            ->firstOrFail();
    }
}

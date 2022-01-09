<?php

namespace App\Repositories\Eloquent;

use App\Models\Filter;
use App\Models\Segment;
use App\Repositories\FilterRepositoryInterface;

class FilterRepository implements FilterRepositoryInterface
{
    public function save($data)
    {
        return Filter::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getParentsBySegment(Segment $segment)
    {
        return $segment
            ->filters()
            ->whereNull('parent_id')
            ->with('children')
            ->get();
    }
}

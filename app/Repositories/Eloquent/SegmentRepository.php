<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\Segment;
use App\Repositories\SegmentRepositoryInterface;

class SegmentRepository implements SegmentRepositoryInterface
{

    public function save($data)
    {
        return Segment::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getById(int $id)
    {
        return Segment::findOrFail($id);
    }

    public function getByIdAndUser(int $id, UserInterface $userDecorator)
    {
        return $userDecorator
            ->segments()
            ->where('id', $id)
            ->with('filters')
            ->firstOrFail();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate, $search = null)
    {
        return $userDecorator
            ->segments()
            ->when($search, function ($query, $search){
                $query->where('name', 'LIKE', "%$search%");
            })
            ->withCount('pushUsers')
            ->paginate($paginate);
    }

    public function getByUser(UserInterface $userDecorator)
    {
        return $userDecorator->segments()
            ->get();
    }

    public function getByUserAndIds(UserInterface $userDecorator, $ids)
    {
        return $userDecorator->segments()
            ->whereIn('id', $ids)
            ->get();
    }

    public function getAll()
    {
        return Segment::with('user')
            ->get();
    }
}

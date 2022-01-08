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
        return Segment::find($id);
    }

    public function getByIdAndUser(int $id, UserInterface $userDecorator)
    {
        return $userDecorator
            ->segments()
            ->where('id', $id)
            ->with('filters')
            ->first();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate)
    {
        return $userDecorator
            ->segments()
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

<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\WeeklyPush;
use App\Repositories\WeeklyPushRepositoryInterface;

class WeeklyPushRepository implements WeeklyPushRepositoryInterface
{

    public function save($data)
    {
        return WeeklyPush::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getByIdAndUser(int $id, UserInterface $userDecorator){
        return $userDecorator
            ->weeklyPushes()
            ->with('apps')
            ->with('segments')
            ->with('template')
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate, $search = null){
        return $userDecorator->weeklyPushes()
            ->when($search, function ($query, $search){
                $query->where('name', 'LIKE', "%$search%");
            })
            ->orderByDesc('id')
            ->paginate($paginate);
    }

    public function getByUser(UserInterface $userDecorator)
    {
        return $userDecorator
            ->weeklyPushes()
            ->get();
    }

    public function getByUserAndIds(UserInterface $userDecorator, $ids)
    {
        return $userDecorator->weeklyPushes()
            ->whereIn('id', $ids)
            ->get();
    }

}

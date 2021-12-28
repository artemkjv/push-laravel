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
            ->first();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate){
        return $userDecorator->weeklyPushes()
            ->paginate($paginate);
    }

}

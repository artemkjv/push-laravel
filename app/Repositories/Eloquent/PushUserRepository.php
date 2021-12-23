<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\PushUser;
use App\Repositories\PushUserRepositoryInterface;

class PushUserRepository implements PushUserRepositoryInterface
{

    public function save($data)
    {
    }

    public function getByIdAndUser(int $id, UserInterface $userDecorator)
    {
        $appIds = $userDecorator->apps()
            ->select('id')
            ->get();
        return PushUser::query()
            ->whereIn('app_id', $appIds)
            ->where('id', $id)
            ->first();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate)
    {
        $appIds = $userDecorator->apps()
            ->select('id')
            ->get();
        return PushUser::whereIn('app_id', $appIds)
            ->with('country')
            ->with('language')
            ->with('platform')
            ->with('timezone')
            ->paginate($paginate);
    }
}

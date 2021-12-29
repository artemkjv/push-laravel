<?php


namespace App\Repositories\Eloquent;


use App\Libraries\Decoration\UserInterface;
use App\Models\AutoPush;
use App\Repositories\AutoPushRepositoryInterface;

class AutoPushRepository implements AutoPushRepositoryInterface
{

    public function save($data)
    {
        return AutoPush::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getByIdAndUser(int $id, UserInterface $userDecorator){
        return $userDecorator
            ->autoPushes()
            ->with('apps')
            ->with('segments')
            ->with('template')
            ->where('id', $id)
            ->first();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate){
        return $userDecorator->autoPushes()
            ->paginate($paginate);
    }
}

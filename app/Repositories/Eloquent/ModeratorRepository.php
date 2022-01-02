<?php


namespace App\Repositories\Eloquent;


use App\Libraries\Decoration\UserInterface;
use App\Models\User;
use App\Repositories\ModeratorRepositoryInterface;

class ModeratorRepository implements ModeratorRepositoryInterface
{

    public function save($data)
    {
        return User::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getByIdAndUser(int $id, UserInterface $userDecorator)
    {
        return $userDecorator
            ->moderators()
            ->where('id', $id)
            ->first();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate)
    {
        return $userDecorator->moderators()
            ->paginate($paginate);
    }

}

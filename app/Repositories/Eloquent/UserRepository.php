<?php


namespace App\Repositories\Eloquent;


use App\Libraries\Decoration\UserInterface;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function save($data)
    {
        return User::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getModeratorByIdAndUser(int $id, UserInterface $userDecorator)
    {
        return $userDecorator
            ->moderators()
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getModeratorsByUserPaginated(UserInterface $userDecorator, int $paginate)
    {
        return $userDecorator->moderators()
            ->paginate($paginate);
    }

    public function getManagersPaginated(int $paginate, $search = null){
        return User::query()
            ->where('role', config('roles.manager'))
            ->when($search, function ($query, $search){
                $query->where('email', 'LIKE', "%$search%");
            })
            ->paginate($paginate);
    }

    public function getManagerById(int $id){
        return User::query()
            ->where('role', config('roles.manager'))
            ->with('managedUsers')
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getManagedUsersByUserPaginated(UserInterface $userDecorator, int $paginate, $search = null)
    {
        return $userDecorator->managedUsers()
            ->when($search, function ($query, $search){
                $query->where('email', 'LIKE', "%$search%");
            })
            ->paginate($paginate);
    }

    public function getManagedUserByIdAndUser(int $id, UserInterface $userDecorator){
        return $userDecorator->managedUsers()
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getManagedUsers(UserInterface $userDecorator)
    {
        return $userDecorator->managedUsers()
            ->get();
    }

    public function getManagedUsersByIdsAndUser($ids, UserInterface $userDecorator)
    {
        return $userDecorator->managedUsers()
            ->whereIn('id', $ids)
            ->get();
    }
}

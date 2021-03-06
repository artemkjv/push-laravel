<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\CustomPush;
use App\Repositories\CustomPushRepositoryInterface;

class CustomPushRepository implements CustomPushRepositoryInterface
{

    public function save($data)
    {
        return CustomPush::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getByIdAndUser(int $id, UserInterface $userDecorator){
        return $userDecorator
            ->customPushes()
            ->with('apps')
            ->with('segments')
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate, $search = null){
        return $userDecorator->customPushes()
            ->when($search, function ($query, $search){
                $query->where('name', 'LIKE', "%$search%");
            })
            ->orderByDesc('id')
            ->paginate($paginate);
    }

    public function getByUser(UserInterface $userDecorator)
    {
        return $userDecorator
            ->customPushes()
            ->get();
    }

    public function getByUserAndIds(UserInterface $userDecorator, $ids)
    {
        return $userDecorator->customPushes()
            ->whereIn('id', $ids)
            ->get();
    }

    public function getById(int $id)
    {
        return CustomPush::query()
            ->with('apps')
            ->with('segments')
            ->findOrFail($id);
    }
}

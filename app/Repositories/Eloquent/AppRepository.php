<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\App;
use App\Repositories\AppRepositoryInterface;

class AppRepository implements AppRepositoryInterface
{

    public function save($data)
    {
        return App::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getById(int $id){
        return App::query()
            ->where('id', $id)
            ->with('platforms')
            ->firstOrFail();
    }

    public function getByIdAndUser(int $id, UserInterface $userDecorator){
        return $userDecorator
            ->apps()
            ->where('id', $id)
            ->with('platforms')
            ->firstOrFail();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate, $search = null){
        return $userDecorator->apps()
            ->with('platforms')
            ->when($search, function ($query, $search){
                $query->where('title', 'LIKE', "%$search%");
            })
            ->withCount('pushUsers')
            ->orderByDesc('id')
            ->paginate($paginate);
    }

    public function getByUser(UserInterface $userDecorator)
    {
        return $userDecorator->apps()
            ->get();
    }

    public function getByUserAndIds(UserInterface $userDecorator, $ids)
    {
        return $userDecorator->apps()
            ->whereIn('id', $ids)
            ->get();
    }

    public function getByUUID($uuid)
    {
        return App::where('uuid', $uuid)
            ->firstOrFail();
    }

    public function getBySafariWebId($safariWebId)
    {
        return App::where('safari_web_id', $safariWebId)
            ->firstOrFail();
    }
}

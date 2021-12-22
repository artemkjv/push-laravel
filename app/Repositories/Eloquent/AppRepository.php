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
        return App::where('id', $id)
            ->with('platforms')
            ->first();
    }

    public function getByIdAndUser(int $id, UserInterface $userDecorator){
        return $userDecorator
            ->apps()
            ->where('id', $id)
            ->with('platforms')
            ->first();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate){
        return $userDecorator->apps()
            ->with('platforms')
            ->withCount('pushUsers')
            ->paginate(10);
    }

}

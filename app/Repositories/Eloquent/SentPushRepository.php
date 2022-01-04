<?php


namespace App\Repositories\Eloquent;


use App\Libraries\Decoration\UserInterface;
use App\Models\SentPush;
use App\Repositories\SentPushRepositoryInterface;

class SentPushRepository implements SentPushRepositoryInterface
{

    public function getByPushableIdAndType($pushableId, $pushableType)
    {
        return SentPush::where('pushable_id', $pushableId)
            ->where('pushable_type', $pushableType);
    }

    public function save($data)
    {
        return SentPush::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate, $pushableType = null)
    {
        return $userDecorator
            ->sentPushes()
            ->when($pushableType, function ($query) use ($pushableType){
                $query->where('pushable_type', $pushableType);
            })
            ->paginate($paginate);
    }
}

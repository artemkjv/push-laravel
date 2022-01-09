<?php


namespace App\Repositories\Eloquent;


use App\Libraries\Decoration\UserInterface;
use App\Models\App;
use App\Models\AutoPush;
use App\Repositories\AutoPushRepositoryInterface;
use Illuminate\Support\Collection;

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

    public function getByUser(UserInterface $userDecorator)
    {
        return $userDecorator
            ->autoPushes()
            ->get();
    }

    public function getByUserAndIds(UserInterface $userDecorator, $ids)
    {
        return $userDecorator->autoPushes()
            ->whereIn('id', $ids)
            ->get();
    }

    public function getBySegmentsAndApp(Collection $segments, App $app)
    {
        return AutoPush::query()
            ->join('segment_auto_push', function ($join) use ($segments){
                $segmentIds = $segments->pluck('id');
                $join->on('auto_push.id', '=', 'segment_auto_push.auto_push_id')
                    ->whereIn('segment_auto_push.segment_id', $segmentIds);
            })
            ->join('app_auto_push', function ($join) use ($app){
               $join->on('auto_push.id', '=', 'app_auto_push.auto_push_id')
                   ->where('app_auto_push.app_id', $app->id);
            })->get();
    }
}

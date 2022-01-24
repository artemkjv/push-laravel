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
            ->firstOrFail();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate, $search = null){
        return $userDecorator->autoPushes()
            ->when($search, function ($query, $search){
                $query->where('name', 'LIKE', "%$search%");
            })
            ->orderByDesc('id')
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
            ->where('status', 'ACTIVE')
            ->with('segments')
            ->when($segments->isNotEmpty(), function ($query) use ($segments){
                $query->whereHas('segments', function ($query) use ($segments){
                    $segmentIds = $segments->pluck('id');
                    $query->whereIn('segments.id', $segmentIds);
                });
            })
            ->when($segments->isEmpty(), function ($query){
                $query->whereDoesntHave('segments');
            })
            ->whereHas('apps', function ($query) use ($app){
                $query->where('apps.id', $app->id);
            })
            ->get();
    }
}

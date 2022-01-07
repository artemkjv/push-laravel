<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\PushUser;
use App\Models\Timezone;
use App\Repositories\PushUserRepositoryInterface;
use Illuminate\Support\Collection;

class PushUserRepository implements PushUserRepositoryInterface
{

    public function save($data)
    {
        return PushUser::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
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

    public function getByUUID($uuid)
    {
        return PushUser::where('uuid', $uuid)
            ->firstOrFail();
    }

    public function getByAppsAndSegmentsAndTimezone(Collection $apps, Collection $segments, Timezone $timezone)
    {
        $appIds = $apps->pluck('id');
        return PushUser::query()
            ->with('app')
            ->with('language')
            ->whereIn('app_id', $appIds)
            ->where('timezone_id', $timezone->id)
            ->join('push_user_segment', function ($join) use ($segments){
                $segmentIds = $segments->pluck('id');
                $join->on('push_users.id', '=', 'push_user_segment.push_user_id')
                    ->whereIn('push_user_segment.segment_id', $segmentIds);
            })->get();

    }
}

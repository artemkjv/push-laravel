<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\PushUser;
use App\Models\Segment;
use App\Models\Timezone;
use App\Repositories\FilterRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class PushUserRepository implements PushUserRepositoryInterface
{

    private FilterRepositoryInterface $filterRepository;

    public function __construct()
    {
        $this->filterRepository = App::make(FilterRepositoryInterface::class);
    }

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
            ->firstOrFail();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate, $segmentIds, $appIds, $countryIds, $languageIds, $platformIds)
    {
        $apps = $userDecorator->apps()
            ->select('id')
            ->get()
            ->pluck('id');
        return PushUser::whereIn('app_id', $apps)
            ->orderByDesc('id')
            ->when($segmentIds, function ($query, $segmentIds){
                $query->whereHas('segments', function ($query) use ($segmentIds){
                   $query->whereIn('segments.id', $segmentIds);
                });
            })
            ->when($appIds, function ($query, $appIds){
                $query->whereIn('app_id', $appIds);
            })
            ->when($countryIds, function ($query, $countryIds){
                $query->whereIn('country_id', $countryIds);
            })
            ->when($languageIds, function ($query, $languageIds){
                $query->whereIn('language_id', $languageIds);
            })
            ->when($platformIds, function ($query, $platformIds){
                $query->whereIn('platform_id', $platformIds);
            })
            ->with('country')
            ->with('language')
            ->with('platform')
            ->with('timezone')
            ->with('app')
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
            ->where('status', 'SUBSCRIBED')
            ->with('app')
            ->with('language')
            ->whereIn('app_id', $appIds)
            ->where('timezone_id', $timezone->id)
            ->when($segments->isNotEmpty(), function ($query) use ($segments){
                $segmentIds = $segments->pluck('id');
                $query->hasMany('segments', function ($query) use ($segmentIds){
                    $query->whereIn('segments.id', $segmentIds);
                });
            })->get();

    }

    public function getByAppsAndSegments(Collection $apps, Collection $segments)
    {
        $appIds = $apps->pluck('id');
        return PushUser::query()
            ->where('status', 'SUBSCRIBED')
            ->with('app')
            ->with('language')
            ->whereIn('app_id', $appIds)
            ->when($segments->isNotEmpty(), function ($query) use ($segments){
                $segmentIds = $segments->pluck('id');
                $query->whereHas('segments', function ($query) use ($segmentIds){
                    $query->whereIn('segments.id', $segmentIds);
                });
            })
            ->get();
    }

    public function getNotRelatedWithSegmentByApps(Segment $segment, Collection $apps)
    {
        $parentFilters = $this->filterRepository->getParentsBySegment($segment);
        $appIds = $apps->pluck('id');
        return PushUser::query()
            ->whereIn('app_id', $appIds)
            ->where(function ($query) use ($parentFilters){
                foreach ($parentFilters as $key => $parentFilter){
                    $children = $parentFilter->children;
                    $handleFilters = function ($query) use ($children, $parentFilter){
                        $parentFilter->toQuery($query);
                        foreach ($children as $childFilter){
                            $childFilter->toQuery($query);
                        }
                    };
                    if($key === $parentFilters->take(1)->keys()->first()){
                        $query->where($handleFilters);
                    } else{
                        $query->orWhere($handleFilters);
                    }
                }
            })->get();

    }

    public function getByRegistrationId($registrationId)
    {
        return PushUser::where('registration_id', $registrationId)
            ->firstOrFail();
    }
}

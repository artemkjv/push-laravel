<?php


namespace App\Repositories\Eloquent;


use App\Models\PushTransition;
use App\Repositories\PushTransitionRepositoryInterface;

class PushTransitionRepository implements PushTransitionRepositoryInterface
{

    public function getCount($apps, $segments, $from = null, $to = null)
    {
         return \DB::table('push_transitions')
             ->select(
                 \DB::raw('YEAR(clicked_at) as year'),
                 \DB::raw('MONTH(clicked_at) as month'),
                 \DB::raw('DAY(clicked_at) as day'),
                 \DB::raw('COUNT(push_transitions.id) as count')
             )
             ->groupBy('year', 'month', 'day')
             ->join('push_users', function ($join) use($apps, $segments){
                 $appIds = $apps->map(function ($app){
                    return $app->id;
                 });
                $join->on('push_transitions.push_user_id', '=', 'push_users.id')
                    ->whereIn('push_users.app_id', $appIds);
                $segmentIds = $segments->map(function ($segment){
                    return $segment->id;
                });
                $join->join('push_user_segment', 'push_users.id', '=', 'push_user_segment.push_user_id')
                    ->whereIn('push_user_segment.segment_id', $segmentIds);
             })
            ->get();
    }
}

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
                 \DB::raw('DATE(clicked_at) as clicked_at_date'),
                 \DB::raw('COUNT(push_transitions.id) as count')
             )
             ->groupBy('clicked_at_date')
             ->join('push_users', function ($join) use ($apps){
                 $appIds = $apps->map(function ($app){
                    return $app->id;
                 });
                $join->on('push_transitions.push_user_id', '=', 'push_users.id')
                    ->whereIn('push_users.app_id', $appIds);
             })
             ->join('push_user_segment', function ($join) use ($segments){
                $segmentIds = $segments->map(function ($segment){
                    return $segment->id;
                });
                $join->on('push_users.id', '=', 'push_user_segment.push_user_id')
                    ->whereIn('push_user_segment.segment_id', $segmentIds);
             })
             ->when($from, function ($qb, $from){
                 return $qb->where('push_transitions.clicked_at', '>=', $from);
             })
             ->when($to, function ($qb, $to){
                 return $qb->where('push_transitions.clicked_at', '<=', $to);
             })->get();
    }

    public function save($data)
    {
        return PushTransition::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }
}

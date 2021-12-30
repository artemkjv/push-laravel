<?php


namespace App\Repositories\Eloquent;


use App\Models\PushTransition;
use App\Repositories\PushTransitionRepositoryInterface;

class PushTransitionRepository implements PushTransitionRepositoryInterface
{

    public function getCount($apps, $segments, $from = null, $to = null)
    {
         \DB::table('push_transitions')
             ->select(
                 'YEAR(clicked_at) as year',
                 'MONTH(clicked_at) as month',
                 'DAY(clicked_at) as day'
             )
             ->join('push_users', function ($join) use($apps, $segments){
                $join->on('push_transitions.push_user_id', '=', 'push_users.id')
                    ->where('push_users.app_id', 'IN', $apps);
             })
            ->get();
    }
}

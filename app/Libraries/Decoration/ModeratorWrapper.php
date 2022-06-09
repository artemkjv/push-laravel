<?php

namespace App\Libraries\Decoration;

use App\Models\App;
use App\Models\AutoPush;
use App\Models\CustomPush;
use App\Models\Segment;
use App\Models\SentPush;
use App\Models\Template;
use App\Models\User;
use App\Models\WeeklyPush;
use Illuminate\Support\Collection;

class ModeratorWrapper implements UserInterface
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function apps()
    {
        return $this->user->morphedByMany(App::class, 'entityable');
    }

    public function segments()
    {
        return $this->user->morphedByMany(Segment::class, 'entityable');
    }

    public function templates()
    {
        return $this->user->morphedByMany(Template::class, 'entityable');
    }

    public function autoPushes()
    {
        return $this->user->morphedByMany(AutoPush::class, 'entityable');
    }

    public function customPushes()
    {
        return $this->user->morphedByMany(CustomPush::class, 'entityable');
    }

    public function weeklyPushes()
    {
        return $this->user->morphedByMany(WeeklyPush::class, 'entityable');
    }

    public function moderators()
    {
        return null;
    }

    public function admin()
    {
        return $this->user->admin();
    }

    public function sentPushes()
    {
        $weeklyPushIds = $this->weeklyPushes()->select('id')->pluck('id');
        $autoPushIds = $this->autoPushes()->select('id')->get()->pluck('id');
        $customPushIds = $this->customPushes()->select('id')->pluck('id');
        return SentPush::query()
            ->when($weeklyPushIds->isEmpty() && $autoPushIds->isEmpty() && $customPushIds->isEmpty(), function ($query){
                $query->where('id', 0);
            })
            ->where(function ($query) use ($weeklyPushIds, $autoPushIds, $customPushIds){
            if($customPushIds->count()){
                $query->where(function($query) use ($customPushIds){
                    $query->whereIn('pushable_id', $customPushIds);
                    $query->where('pushable_type', CustomPush::class);
                });
            }

            if($autoPushIds->count()){
                $query->orWhere(function($query) use ($autoPushIds){
                    $query->whereIn('pushable_id', $autoPushIds);
                    $query->where('pushable_type', AutoPush::class);
                });
            }

            if($weeklyPushIds->count()) {
                $query->orWhere(function ($query) use ($weeklyPushIds) {
                    $query->whereIn('pushable_id', $weeklyPushIds);
                    $query->where('pushable_type', WeeklyPush::class);
                });
            }
        });
    }

    public function managedUsers()
    {
        return null;
    }

    public function tariff()
    {
        return $this->user->admin->tariff();
    }

    public function apiTokens()
    {
        return $this->user->apiTokens();
    }

}

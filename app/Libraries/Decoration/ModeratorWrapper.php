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

    public function sentCustomPushes()
    {
        $customPushIds = $this->customPushes()
            ->select('id')
            ->get();
        return SentPush::whereIn('pushable_id', $customPushIds)
            ->where('pushable_type', CustomPush::class);
    }

    public function sentAutoPushes()
    {
        $autoPushIds = $this->autoPushes()
            ->select('id')
            ->get();
        return SentPush::whereIn('pushable_id', $autoPushIds)
            ->where('pushable_type', AutoPush::class);
    }

    public function sentWeeklyPushes()
    {
        $weeklyPushIds = $this->weeklyPushes()
            ->select('id')
            ->get();
        return SentPush::whereIn('pushable_id', $weeklyPushIds)
            ->where('pushable_type', WeeklyPush::class);
    }
}

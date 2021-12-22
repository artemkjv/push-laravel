<?php

namespace App\Libraries\Decoration;

use App\Models\App;
use App\Models\AutoPush;
use App\Models\CustomPush;
use App\Models\Segment;
use App\Models\Template;
use App\Models\User;
use App\Models\WeeklyPush;

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
}

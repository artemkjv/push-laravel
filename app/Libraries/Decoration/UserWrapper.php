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

class UserWrapper implements UserInterface
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function apps()
    {
        return $this->user->hasMany(App::class);
    }

    public function segments()
    {
        return $this->user->hasMany(Segment::class);
    }

    public function templates()
    {
        return $this->user->hasMany(Template::class);
    }

    public function autoPushes()
    {
        return $this->user->hasMany(AutoPush::class);
    }

    public function customPushes()
    {
        return $this->user->hasMany(CustomPush::class);
    }

    public function weeklyPushes()
    {
        return $this->user->hasMany(WeeklyPush::class);
    }

    public function moderators()
    {
        return $this->user->hasMany(User::class, 'admin_id');
    }

    public function admin()
    {
        return null;
    }

    public function sentCustomPushes()
    {
        return $this->user
            ->hasMany(SentPush::class)
            ->where('pushable_type', CustomPush::class);
    }

    public function sentAutoPushes()
    {
        return $this->user
            ->hasMany(SentPush::class)
            ->where('pushable_type', AutoPush::class);
    }

    public function sentWeeklyPushes(){
        return $this->user
            ->hasMany(SentPush::class)
            ->where('pushable_type', WeeklyPush::class);
    }

    public function sentPushes()
    {
        return $this->user->hasMany(SentPush::class);
    }
}

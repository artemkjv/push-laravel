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
        return $this->user->apps();
    }

    public function segments()
    {
        return $this->user->segments();
    }

    public function templates()
    {
        return $this->user->templates();
    }

    public function autoPushes()
    {
        return $this->user->autoPushes();
    }

    public function customPushes()
    {
        return $this->user->customPushes();
    }

    public function weeklyPushes()
    {
        return $this->user->weeklyPushes();
    }

    public function moderators()
    {
        return $this->user->moderators();
    }

    public function admin()
    {
        return null;
    }

    public function sentPushes()
    {
        return $this->user->sentPushes();
    }

    public function managedUsers()
    {
        return null;
    }
}

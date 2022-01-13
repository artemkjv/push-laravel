<?php


namespace App\Libraries\Decoration;


use App\Models\User;

class ManagerWrapper implements UserInterface
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
        return $this->user
            ->managedUsers()
            ->where('role', config('roles.user'));
    }
}

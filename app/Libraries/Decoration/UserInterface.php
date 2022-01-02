<?php

namespace App\Libraries\Decoration;

interface UserInterface
{

    public function apps();

    public function segments();

    public function templates();

    public function autoPushes();

    public function customPushes();

    public function weeklyPushes();

    public function moderators();

    public function admin();

}

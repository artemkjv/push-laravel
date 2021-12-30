<?php


namespace App\Repositories;


interface PushTransitionRepositoryInterface
{

    public function getCount($apps, $segments, $from = null, $to = null);

}

<?php

namespace App\Repositories;

use App\Libraries\Decoration\UserInterface;
use App\Models\Timezone;
use Illuminate\Support\Collection;

interface PushUserRepositoryInterface
{

    public function save($data);

    public function getByIdAndUser(int $id, UserInterface $userDecorator);

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate);

    public function getByUUID($uuid);

    public function getByAppsAndSegmentsAndTimezone(Collection $apps, Collection $segments, Timezone $timezone);

}

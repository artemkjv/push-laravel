<?php

namespace App\Repositories;

use App\Libraries\Decoration\UserInterface;

interface ApiTokenRepositoryInterface
{

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate);

    public function save($payload);

    public function getByUserAndId(UserInterface $userDecorator, int $id);

    public function getByTokenNotExpired($token);

}

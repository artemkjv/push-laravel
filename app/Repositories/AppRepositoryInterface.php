<?php

namespace App\Repositories;

use App\Libraries\Decoration\UserInterface;

interface AppRepositoryInterface
{

    public function save($data);

    public function getById(int $id);

    public function getByIdAndUser(int $id, UserInterface $userDecorator);

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate);

}

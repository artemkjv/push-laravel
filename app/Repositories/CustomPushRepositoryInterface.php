<?php

namespace App\Repositories;

use App\Libraries\Decoration\UserInterface;

interface CustomPushRepositoryInterface
{

    public function save($data);

    public function getByIdAndUser(int $id, UserInterface $userDecorator);

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate, $search = null);

    public function getByUser(UserInterface $userDecorator);

    public function getByUserAndIds(UserInterface $userDecorator, $ids);

    public function getById(int $id);

}

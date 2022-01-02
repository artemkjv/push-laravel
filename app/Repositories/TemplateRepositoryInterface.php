<?php

namespace App\Repositories;

use App\Libraries\Decoration\UserInterface;

interface TemplateRepositoryInterface
{

    public function getAll();

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate);

    public function getByIdAndUser(int $id, UserInterface $userDecorator);

    public function getByUser(UserInterface $userDecorator);

    public function save($data);

    public function getByUserAndIds(UserInterface $userDecorator, $ids);

}

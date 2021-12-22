<?php

namespace App\Repositories;

use App\Libraries\Decoration\UserInterface;

interface TemplateRepositoryInterface
{

    public function getAll();

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate);

}

<?php

namespace App\Repositories;

use App\Libraries\Decoration\UserInterface;

interface ApiTokenRepositoryInterface
{

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate);

}

<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Repositories\ApiTokenRepositoryInterface;

class ApiTokenRepository implements ApiTokenRepositoryInterface
{

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate)
    {
        return $userDecorator->apiTokens()
            ->with('apiPages')
            ->orderByDesc('id')
            ->paginate($paginate)
            ->appends(request()->except('page'));
    }
}

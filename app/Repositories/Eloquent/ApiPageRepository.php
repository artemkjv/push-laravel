<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\ApiToken;
use App\Repositories\ApiPageRepositoryInterface;
use App\Repositories\ApiTokenRepositoryInterface;
use Carbon\Carbon;

class ApiPageRepository implements ApiPageRepositoryInterface
{


    public function getByApiTokenAndRoute(ApiToken $apiToken, string $route)
    {
        return $apiToken->apiPages()
            ->where('route', $route)
            ->firstOrFail();
    }
}

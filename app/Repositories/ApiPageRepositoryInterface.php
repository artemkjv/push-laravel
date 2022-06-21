<?php

namespace App\Repositories;

use App\Libraries\Decoration\UserInterface;
use App\Models\ApiToken;

interface ApiPageRepositoryInterface
{

    public function getByApiTokenAndRoute(ApiToken $apiToken, string $route);

}

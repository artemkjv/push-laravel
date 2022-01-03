<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppResource;
use App\Repositories\AppRepositoryInterface;
use Illuminate\Http\Request;

class AppController extends Controller
{

    private AppRepositoryInterface $appRepository;

    public function __construct(
        AppRepositoryInterface $appRepository
    )
    {
        $this->appRepository = $appRepository;
    }

    public function show($uuid){
        return new AppResource(
            $this->appRepository->getByUUID($uuid)
        );
    }

}

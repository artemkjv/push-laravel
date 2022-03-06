<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAppRequest;
use App\Http\Resources\AppResource;
use App\Models\App;
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

    public function store(StoreAppRequest $request){
        $payload = $request->validated();
        return new AppResource(
            $this->appRepository->save($payload)
        );
    }

}

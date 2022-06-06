<?php

namespace App\Http\Controllers;

use App\Libraries\Decoration\UserInterface;
use App\Models\ApiToken;
use App\Repositories\ApiTokenRepositoryInterface;
use Illuminate\Http\Request;

class ApiTokenController extends Controller
{

    private ApiTokenRepositoryInterface $apiTokenRepository;

    public function __construct(
        ApiTokenRepositoryInterface $apiTokenRepository
    )
    {
        $this->apiTokenRepository = $apiTokenRepository;
    }

    public function index() {
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apiTokens = $this->apiTokenRepository->getByUserPaginated(
            $userDecorator,
            request()->get('limit') ?? ApiToken::PAGINATE,
        );
        return view('api-token.index', compact('apiTokens'));
    }

}

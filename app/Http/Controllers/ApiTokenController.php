<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiToken\StoreRequest;
use App\Libraries\Decoration\UserInterface;
use App\Models\ApiPage;
use App\Models\ApiToken;
use App\Repositories\ApiTokenRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function create() {
        $apiPages = ApiPage::all();
        return view('api-token.create', compact('apiPages'));
    }

    public function store(StoreRequest $request) {
        $payload = $request->validated();
        $payload['user_id'] = $request->user()->id;
        $token = Str::random(60);
        $payload['token'] = hash('sha256', $token);
        $this->apiTokenRepository->save($payload);
        return redirect()->route('apiToken.index');
    }

    public function destroy($id) {
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apiToken = $this->apiTokenRepository->getByUserAndId($userDecorator, $id);
        $apiToken->delete();
        return redirect()->back();
    }

}

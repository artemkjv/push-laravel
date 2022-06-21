<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\ApiToken;
use App\Repositories\ApiTokenRepositoryInterface;
use Carbon\Carbon;

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

    public function save($payload)
    {
        $apiToken = ApiToken::updateOrCreate([
            'id' => $payload['id'] ?? null
        ], $payload);
        $apiToken->apiPages()->sync($payload['actions']);
    }

    public function getByUserAndId(UserInterface $userDecorator, int $id)
    {
        return $userDecorator->apiTokens()
            ->findOrFail($id);
    }

    public function getByTokenNotExpired($token)
    {
        return ApiToken::query()
            ->where('expires_at', '>=', Carbon::now()->format('Y-m-d'))
            ->where('token', $token)
            ->firstOrFail();
    }
}

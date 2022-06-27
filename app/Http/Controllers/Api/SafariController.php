<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AppRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class SafariController extends Controller
{

    private AppRepositoryInterface $appRepository;

    public function __construct(AppRepositoryInterface $appRepository)
    {
        $this->appRepository = $appRepository;
    }

    public function showPackage($safariWebId) {
        $app = $this->appRepository->getBySafariWebId($safariWebId);
        $path = "package-pushes/{$app->user_id}/{$app->id}/Package_Push.zip";
        $content = Storage::get($path);
        $response = Response::make($content);
        $response->header('Content-Type', 'application/zip');
        $response->header('Content-Disposition', 'attachment; filename="Package_Push.zip');
        $response->header('Content-length', Storage::size($path));
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', 0);
        return $response;
    }

    public function log() {
        File::put(base_path('/log.txt'), implode('|', \request()->all()));
        return \response('', 200);
    }

    public function register() {
        return \response('', 200);
    }

}

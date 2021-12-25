<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppRequest;
use App\Http\Requests\UpdateAppRequest;
use App\Libraries\Decoration\UserInterface;
use App\Models\App;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;

class AppController extends Controller
{

    private PlatformRepositoryInterface $platformRepository;
    private AppRepositoryInterface $appRepository;

    public function __construct(
        PlatformRepositoryInterface $platformRepository,
        AppRepositoryInterface $appRepository
    )
    {
        $this->platformRepository = $platformRepository;
        $this->appRepository = $appRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUserPaginated($userDecorator, App::PAGINATE);
        return view('app.index', compact('apps'));
    }

    public function create(){
        $platforms = $this->platformRepository->getAll();
        return view('app.create', compact('platforms'));
    }

    public function store(StoreAppRequest $request){
        $validated = $request->validated();
        $platform_id = $validated['platform_id'];
        unset($validated['platform_id']);
        $app = $this->appRepository->save($validated);
        $app->platforms()->attach([$platform_id]);
        return redirect()->route('app.show', ['id' => $app->id]);
    }

    public function edit($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $platforms = $this->platformRepository->getAll();
        return view('app.edit', compact('app', 'platforms'));
    }

    public function show($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        return view('app.show', compact('app'));
    }

    public function update(UpdateAppRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $validated = $request->validated();
        $platforms = $validated['platforms'];
        unset($validated['platforms']);
        $app->update($validated);
        $app->platforms()->sync($platforms);
        return redirect()->route('app.index');
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $app = $this->appRepository->getByIdAndUser($id, $userDecorator);
        $app->delete();
        return redirect()->back();
    }

}

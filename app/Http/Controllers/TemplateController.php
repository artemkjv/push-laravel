<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Libraries\Decoration\UserInterface;
use App\Models\Template;
use App\Repositories\TemplateRepositoryInterface;
use App\Services\TemplateService;

class TemplateController extends Controller
{

    private TemplateRepositoryInterface $templateRepository;
    private TemplateService $templateService;

    public function __construct(
        TemplateRepositoryInterface $templateRepository,
        TemplateService $templateService
    )
    {
        $this->templateRepository = $templateRepository;
        $this->templateService = $templateService;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $templates = $this->templateRepository
            ->getByUserPaginated(
                $userDecorator,
                request()->get('limit') ?? Template::PAGINATE,
                request()->get('search')
            );
        return view('template.index', compact('templates'));
    }

    public function create(){
        return view('template.create');
    }

    public function edit($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $template = $this->templateRepository->getByIdAndUser($id, $userDecorator);
        return view('template.edit', compact('template'));
    }

    public function store(StoreTemplateRequest $request){
        $this->authorize('create', Template::class);
        $payload = $request->validated();
        $payload['image'] = $this->templateService->handleUploadedImage($request->file('image'));
        $payload['icon'] = $this->templateService->handleUploadedIcon($request->file('icon'));
        $this->templateRepository->save($payload);
        return redirect()->route('template.index');
    }

    public function update(UpdateTemplateRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $template = $this->templateRepository
            ->getByIdAndUser($id, $userDecorator)
            ->toArray();
        $payload = $request->validated();
        if($payload['template-image']){
            $template['image'] = $this->templateService->handleUploadedImage($request->file('image'));
        }
        if($payload['template-icon']){
            $template['icon'] = $this->templateService->handleUploadedIcon($request->file('icon'));
        }
        $template = array_merge($template, $payload);
        $this->templateRepository->save($template);
        return redirect()->route('template.index');
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $template = $this->templateRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $template);
        $template->delete();
        return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Libraries\Decoration\UserInterface;
use App\Models\Template;
use App\Repositories\TemplateRepositoryInterface;

class TemplateController extends Controller
{

    private TemplateRepositoryInterface $templateRepository;

    public function __construct(
        TemplateRepositoryInterface $templateRepository,
    )
    {
        $this->templateRepository = $templateRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $templates = $this->templateRepository
            ->getByUserPaginated($userDecorator, Template::PAGINATE);
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
        $payload = $request->validated();
        if($request->file('image')){
            $payload['image'] = $request->file('image')->store('images', 'public');
        }
        if($request->file('icon')){
            $payload['icon'] = $request->file('icon')->store('icons', 'public');
        }
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
            $template['image'] = null;
        }
        if($payload['template-icon']){
            $template['icon'] = null;
        }
        if($request->file('image')){
            $payload['image'] = $request->file('image')->store('images', 'public');
        }
        if($request->file('icon')){
            $payload['icon'] = $request->file('icon')->store('icons', 'public');
        }
        $template = array_merge($template, $payload);
        $this->templateRepository->save($template);
        return redirect()->route('template.index');
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $template = $this->templateRepository->getByIdAndUser($id, $userDecorator);
        $template->delete();
        return redirect()->back();
    }

}

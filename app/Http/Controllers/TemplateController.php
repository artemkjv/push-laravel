<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemplateRequest;
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
        $payload['image'] = $request->file('image')->store('images', 'public');
        $payload['icon'] = $request->file('icon')->store('icons', 'public');
        $this->templateRepository->save($payload);
        return redirect()->route('template.index');
    }

}

<?php

namespace App\Http\Controllers;

use App\Libraries\Decoration\UserInterface;
use App\Models\Template;
use App\Repositories\LanguageRepositoryInterface;
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

}

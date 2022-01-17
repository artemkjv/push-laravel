<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Libraries\Decoration\UserInterface;
use App\Libraries\Decoration\UserWrapper;
use App\Models\Template;
use App\Repositories\TemplateRepositoryInterface;
use App\Services\TemplateService;
use Illuminate\Http\Request;

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
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $templates = $this->templateRepository
            ->getByUserPaginated(
                $userDecorator,
                request()->get('limit') ?? Template::PAGINATE,
                request()->get('search')
            )->appends(request()->except('page'));
        return view('admin.template.index', compact('templates', 'user'));
    }

    public function create(){
        $user = \request()->currentUser;
        return view('admin.template.create', compact('user'));
    }

    public function edit($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $template = $this->templateRepository->getByIdAndUser($id, $userDecorator);
        return view('admin.template.edit', compact('template', 'user'));
    }

    public function store(StoreTemplateRequest $request){
        $payload = $request->validated();
        $user = \request()->currentUser;
        $payload['image'] = $this->templateService->handleUploadedImage($request->file('image'));
        $payload['icon'] = $this->templateService->handleUploadedIcon($request->file('icon'));
        $this->templateRepository->save($payload);
        return redirect()->route('admin.template.index', ['userId' => $user->id]);
    }

    public function update(UpdateTemplateRequest $request, $userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
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
        return redirect()->route('admin.template.index', ['userId' => $user->id]);
    }

    public function destroy($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $template = $this->templateRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $template);
        $template->delete();
        return redirect()->back();
    }

}

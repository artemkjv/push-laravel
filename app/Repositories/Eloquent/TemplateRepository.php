<?php

namespace App\Repositories\Eloquent;

use App\Libraries\Decoration\UserInterface;
use App\Models\Template;
use App\Repositories\TemplateRepositoryInterface;

class TemplateRepository implements TemplateRepositoryInterface
{

    public function getAll()
    {
        return Template::all();
    }

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate)
    {
        return $userDecorator
            ->templates()
            ->paginate(10);
    }

}

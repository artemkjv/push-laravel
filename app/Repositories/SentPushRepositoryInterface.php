<?php


namespace App\Repositories;


use App\Libraries\Decoration\UserInterface;

interface SentPushRepositoryInterface
{

    public function save($data);

    public function getById(int $id);

    public function getByPushableIdAndType($pushableId, $pushableType);

    public function getByUserPaginated(UserInterface $userDecorator, int $paginate, $pushableType = null);

    public function getByIdAndUser(int $id, UserInterface $userDecorator);

}

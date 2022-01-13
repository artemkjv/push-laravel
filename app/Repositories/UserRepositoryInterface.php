<?php


namespace App\Repositories;


use App\Libraries\Decoration\UserInterface;

interface UserRepositoryInterface
{

    public function save($data);

    public function getModeratorByIdAndUser(int $id, UserInterface $userDecorator);

    public function getModeratorsByUserPaginated(UserInterface $userDecorator, int $paginate);

    public function getManagersPaginated(int $paginate);

    public function getManagerById(int $id);

    public function getManagedUsersByUserPaginated(UserInterface $userDecorator, int $paginate);

    public function getManagedUserByIdAndUser(int $id, UserInterface $userDecorator);

}

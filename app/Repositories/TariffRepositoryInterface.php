<?php


namespace App\Repositories;


interface TariffRepositoryInterface
{

    public function getAll();

    public function getPaginated(int $paginate);

    public function getById(int $id);

    public function save($data);

    public function getDefault();

}

<?php


namespace App\Repositories;


interface SentPushRepositoryInterface
{

    public function save($data);

    public function getByPushableIdAndType($pushableId, $pushableType);

}

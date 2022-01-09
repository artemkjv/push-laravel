<?php

namespace App\Repositories;

use App\Models\Segment;

interface FilterRepositoryInterface
{

    public function save($data);

    public function getParentsBySegment(Segment $segment);

}

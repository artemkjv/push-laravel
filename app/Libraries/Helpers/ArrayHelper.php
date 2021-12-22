<?php

namespace App\Libraries\Helpers;

use JetBrains\PhpStorm\Pure;

class ArrayHelper
{

    #[Pure] public static function instance(): ArrayHelper
    {
        return new ArrayHelper();
    }

    public function stdCollectionToArray($collection){
        if($collection){
            $collection = json_decode($collection->toJson(), true);
        }
        return $collection;
    }

}

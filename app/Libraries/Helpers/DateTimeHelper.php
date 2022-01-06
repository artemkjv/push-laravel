<?php


namespace App\Libraries\Helpers;


use DateTime;
use JetBrains\PhpStorm\Pure;

class DateTimeHelper
{

    #[Pure] public static function instance(): DateTimeHelper
    {
        return new DateTimeHelper();
    }

    function getClosestDate($dates){
        $now = new DateTime();
        $closestDate = new DateTime('9999-01-01 00:00:00');
        foreach ($dates as $date){
            if($date < $closestDate && $date > $now){
                $closestDate = $date;
            }
        }
        return $closestDate;
    }

}

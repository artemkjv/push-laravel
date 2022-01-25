<?php

namespace App\Libraries\Helpers;

use GuzzleHttp\Client;
use JetBrains\PhpStorm\Pure;

class TimezoneHelper
{

    #[Pure] public static function instance(): TimezoneHelper
    {
        return new TimezoneHelper();
    }

    public function getTimezoneFromIp($ip){
        $client = new Client([
            'base_uri' => "https://pro.ip-api.com/json/"
        ]);
        try {
            $response = $client->get("$ip?key=I9ShYw6mCZh58E4")->getBody()
                ->getContents();
            return json_decode($response, true)['timezone'] ?? 'UTC';
        } catch (\Throwable $e){
            return 'UTC';
        }
    }

    public static function getClientTimezone(){
        return new \DateTimeZone(session('timezone') ?? 'UTC');
    }

    public static function convertTimeToClientTimezone($datetime){
        return (new \DateTimeImmutable($datetime))->setTimezone(self::getClientTimezone())->format('Y-m-d H:i:s');
    }

}

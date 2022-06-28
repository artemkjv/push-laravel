<?php

namespace App\Libraries\Helpers;

use JetBrains\PhpStorm\Pure;

class ImageHelper
{

    #[Pure] public static function instance(): ImageHelper
    {
        return new ImageHelper();
    }

    public function saveBase64Image($encodedImage, $path) {
        $extension = explode('/', explode(':', substr($encodedImage, 0, strpos($encodedImage, ';')))[1])[1];
        $replace = substr($encodedImage, 0, strpos($encodedImage, ',') + 1);
        $image = str_replace($replace, '', $encodedImage);
        $image = str_replace(' ', '+', $image);
        $imageName = \Str::random(40) . ".$extension";
        \Storage::put("public/$path/$imageName", base64_decode($image));
        return "$path/$imageName";
    }

}

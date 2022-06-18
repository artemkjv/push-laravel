<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AppService
{

    public function handleUploadedCertificate($certificate, $password){
        if(!is_null($certificate)){
            $results = [];
            $content = $certificate->getContent();
            if(openssl_pkcs12_read($content, $results, $password)) {
                $pkey = null;
                $cert = null;
                if(!openssl_pkey_export($results['pkey'], $pkey, $password)) {
                    throw new FileException(openssl_error_string());
                }
                if(!openssl_x509_export($results['cert'], $cert, $password)) {
                    throw new FileException(openssl_error_string());
                }
                $path = 'certificates/' . Str::random(24) . time() . '.pem';
                if(Storage::put($path, $cert . $pkey)) return $path;
            }
            throw new FileException(openssl_error_string());
        }
    }

}

<?php

namespace App\Services;

use App\Services\Exceptions\CertificateException;
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
                if(!openssl_pkey_export($results['pkey'], $pkey, $password)) goto exception;
                if(!openssl_x509_export($results['cert'], $cert, $password)) goto exception;
                $path = 'certificates/' . Str::random(24) . time() . '.pem';
                if(Storage::put($path, $cert . $pkey)) return $path;
            }
            exception:
            throw new CertificateException('Something wrong with certificate');
        }
    }

    /**
     * @throws CertificateException
     */
    public function handleUploadedWebCertificate($certificate, $password) {
        if(!is_null($certificate)){
            $results = [];
            $content = $certificate->getContent();
            if(openssl_pkcs12_read($content, $results, $password)) {
                $pkey = null;
                $cert = null;
                if(!openssl_pkey_export($results['pkey'], $pkey, $password)) goto exception;
                if(!openssl_x509_export($results['cert'], $cert, $password)) goto exception;
                $path = 'certificates/' . Str::random(24) . time() . '.pem';
                if(Storage::put($path, $cert . $pkey)) return $path;
            }
            exception:
            throw new CertificateException('Something wrong with certificate');
        }
    }

    public function handleWebIcon($icon) {
        if(!is_null($icon)){
            return $icon->store('web-icons', 'public');
        }
    }

}

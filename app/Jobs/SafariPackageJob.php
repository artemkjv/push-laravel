<?php

namespace App\Jobs;

use App\Models\App;
use App\Services\Exceptions\CertificateException;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use ZipArchive;

class SafariPackageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $certificatePath;
    private int $appId;
    private App $app;

    public const IMAGE_SIZES = [
        16,
        32,
        128
    ];

    public const RAW_FILES = [
        'icon.iconset/icon_16x16.png',
        'icon.iconset/icon_16x16@2x.png',
        'icon.iconset/icon_32x32.png',
        'icon.iconset/icon_32x32@2x.png',
        'icon.iconset/icon_128x128.png',
        'icon.iconset/icon_128x128@2x.png',
        'website.json'
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($certificatePath, App $app)
    {
        $this->certificatePath = $certificatePath;
        $this->app = $app;
        $this->onQueue('safari-certificate');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fullPath = \Storage::path($this->certificatePath);
        $certificatePassword = $this->app->web_private_key;
        $webIcon = \Storage::path($this->app->web_icon);
        $packageDir = "package-pushes/{$this->app->user_id}/{$this->app->id}/";
        $this->createIcons($webIcon, $packageDir);
        $this->createWebsiteConfig($packageDir);
        $this->createManifest($packageDir, 2, self::RAW_FILES);
        $this->createSignature($packageDir, $fullPath, $certificatePassword);
        $this->packageRawData($packageDir, self::RAW_FILES);
    }

    function packageRawData($packageDir, $rawFiles) {
        $zipPath = Storage::path("{$packageDir}Package_Push.zip");
        // Package files as a zip file
        $zip = new ZipArchive();
        if (!$zip->open($zipPath, ZIPARCHIVE::CREATE)) {
            throw new Exception('Could not create ' . $zipPath);
        }

        //$raw_files = raw_files();
        $rawFiles[] = 'manifest.json';
        $rawFiles[] = 'signature';
        foreach ($rawFiles as $rawFile) {
            $zip->addFile(Storage::path("$packageDir$rawFile"), $rawFile);
        }

        $zip->close();
        return $zipPath;
    }

    private function createWebsiteConfig($packageDir) {
        $websiteConfig = [
            'websiteName' => $this->app->site_name,
            'websitePushId' => $this->app->safari_web_id,
            'allowedDomains' => [$this->app->site_url],
            'urlFormatString' => "{$this->app->site_url}/%@",
            'authenticationToken' => '19f8d7a6e9fb8a7f6d9330dabe',
            'webServiceUrl' => config('app.url')
        ];
        $websiteConfigJson = json_encode($websiteConfig);
        \Storage::put($packageDir . 'website.json', $websiteConfigJson);
    }

    function createSignature($packageDir, $certPath, $certPassword) {
        // Load the push notification certificate
        $pkcs12 = file_get_contents($certPath);
        $certs = [];
        if(!openssl_pkcs12_read($pkcs12, $certs, $certPassword)) {
            return;
        }

        $signaturePath = Storage::path("{$packageDir}signature");

        // Sign the manifest.json file with the private key from the certificate
        $certData = openssl_x509_read($certs['cert']);
        $privateKey = openssl_pkey_get_private($certs['pkey'], $certPassword);
        openssl_pkcs7_sign(Storage::path("{$packageDir}manifest.json"), $signaturePath, $certData, $privateKey, [], PKCS7_BINARY | PKCS7_DETACHED,  base_path('/AppleWWDRCA.pem'));

        // Convert the signature from PEM to DER
        $signaturePem = file_get_contents($signaturePath);
        $matches = array();
        if (!preg_match('~Content-Disposition:[^\n]+\s*?([A-Za-z0-9+=/\r\n]+)\s*?-----~', $signaturePem, $matches)) {
            return;
        }
        $signatureDer = base64_decode($matches[1]);
        file_put_contents($signaturePath, $signatureDer);
    }

    private function createIcons($webIcon, $packageDir) {
        $imageDir = $packageDir . 'icon.iconset';
        \Storage::makeDirectory($imageDir);
        foreach (self::IMAGE_SIZES as $imageSize) {
            $icon = Image::make($webIcon)->resize($imageSize, $imageSize, function($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/' . $imageDir . "/icon_{$imageSize}x{$imageSize}.png"));
            $iconTwoX = Image::make($webIcon)->resize($imageSize, $imageSize, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/' . $imageDir . "/icon_{$imageSize}x{$imageSize}@2x.png"));
        }
    }

    private function createManifest($packageDir, $packageVersion, $rawFiles) {
        $manifestData = array();
        foreach ($rawFiles as $rawFile) {
            $fileContents = Storage::get("$packageDir$rawFile");
            if ($packageVersion === 1) {
                $manifestData[$rawFile] = sha1($fileContents);
            } else if ($packageVersion === 2) {
                $hashType = 'sha512';
                $manifestData[$rawFile] = array(
                    'hashType' => $hashType,
                    'hashValue' => hash($hashType, $fileContents),
                );
            } else {
                throw new CertificateException('Invalid push package version.');
            }
        }
        Storage::put("{$packageDir}manifest.json", json_encode((object)$manifestData));
    }



}

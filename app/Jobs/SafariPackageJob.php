<?php

namespace App\Jobs;

use App\Models\App;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

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
        $webIcon = \Storage::get($this->app->web_icon);
        $packageDir = "package-pushes/{$this->app->user_id}/{$this->app->id}/";
        $this->createIcons($webIcon, $packageDir);
        $this->createWebsiteConfig($packageDir);
    }

    private function createWebsiteConfig($packageDir) {
        $websiteConfig = [
            'websiteName' => $this->app->websiteName,
            'websitePushId' => $this->app->safari_web_id,
            'allowedDomains' => [$this->app->site_url],
            'urlFormatString' => "{$this->app->site_url}/%@",
            'authenticationToken' => '19f8d7a6e9fb8a7f6d9330dabe',
            'webServiceUrl' => config('app.url')
        ];
        $websiteConfigJson = json_encode($websiteConfig);
        \Storage::put($packageDir . 'website.json', $websiteConfigJson);
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
}

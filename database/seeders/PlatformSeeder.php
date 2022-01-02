<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeding platforms...');
        $platforms = [
            ['name' => 'Android','docs_url' => '/docs/android','image' => '/assets/images/android_icon.svg'],
            ['name' => 'IOS','docs_url' => '/docs/ios','image' => '/assets/images/apple_icon.svg'],
            ['name' => 'Web','docs_url' => '/docs/web','image' => '/assets/images/chrome_icon.svg']
        ];
        DB::table('platforms')->insert($platforms);
    }
}

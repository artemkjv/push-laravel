<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            /*CountrySeeder::class,
            LanguageSeeder::class,
            TimezoneSeeder::class,
            PlatformSeeder::class,
            PredicateSeeder::class,
            FilterTypeSeeder::class,
            FilterTypePredicateSeeder::class*/
            AutoPushQuerySeeder::class,
            WeeklyPushQuerySeeder::class
        ]);
    }
}

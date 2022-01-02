<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeding filter_types...');
        $filterTypes = [
            ['id' => '1','title' => 'First Session','description' => 'The first date/time the device communicated with our servers','table_name' => NULL,'field_name' => 'created_at','format' => NULL,'measurement' => 'hours ago','key_allowed' => '0'],
            ['id' => '2','title' => 'Last Session','description' => 'The most recent date/time the device communicated with our servers','table_name' => NULL,'field_name' => 'active_at','format' => NULL,'measurement' => 'hours ago','key_allowed' => '0'],
            ['id' => '3','title' => 'Sessions Count','description' => 'Total number of times the device has opened your app or website','table_name' => NULL,'field_name' => 'sessions_count','format' => NULL,'measurement' => 'sessions','key_allowed' => '0'],
            ['id' => '4','title' => 'Language','description' => 'The language of the user\'s device','table_name' => 'languages','field_name' => 'language_id','format' => NULL,'measurement' => '','key_allowed' => '0'],
            ['id' => '5','title' => 'Country','description' => 'Country the device was in the last time it communicated with our servers','table_name' => 'countries','field_name' => 'country_id','format' => NULL,'measurement' => '','key_allowed' => '0'],
            ['id' => '6','title' => 'Platform','description' => 'Device operating system','table_name' => 'platforms','field_name' => 'platform_id','format' => NULL,'measurement' => '','key_allowed' => '0'],
            ['id' => '7','title' => 'Tag','description' => 'User Tag','table_name' => NULL,'field_name' => 'tags','format' => NULL,'measurement' => '','key_allowed' => '1']
        ];
        DB::table('filter_types')->insert($filterTypes);
    }
}

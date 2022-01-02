<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilterTypePredicateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeding filter_type_predicate...');
        $filterTypePredicates = [
            ['filter_type_id' => '1','predicate_id' => '3'],
            ['filter_type_id' => '1','predicate_id' => '4'],
            ['filter_type_id' => '2','predicate_id' => '3'],
            ['filter_type_id' => '2','predicate_id' => '4'],
            ['filter_type_id' => '3','predicate_id' => '1'],
            ['filter_type_id' => '3','predicate_id' => '3'],
            ['filter_type_id' => '3','predicate_id' => '4'],
            ['filter_type_id' => '4','predicate_id' => '1'],
            ['filter_type_id' => '4','predicate_id' => '2'],
            ['filter_type_id' => '5','predicate_id' => '1'],
            ['filter_type_id' => '5','predicate_id' => '2'],
            ['filter_type_id' => '6','predicate_id' => '1'],
            ['filter_type_id' => '6','predicate_id' => '2'],
            ['filter_type_id' => '7','predicate_id' => '5'],
            ['filter_type_id' => '7','predicate_id' => '6']
        ];
        DB::table('filter_type_predicate')->insert($filterTypePredicates);
    }
}

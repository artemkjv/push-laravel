<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredicateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeding predicates...');
        $predicates = [
            ['id' => 1, 'name' => 'Is','value' => '=','option' => NULL],
            ['id' => 2, 'name' => 'Is Not','value' => '!=','option' => NULL],
            ['id' => 3, 'name' => 'Less Than','value' => '<','option' => NULL],
            ['id' => 4, 'name' => 'Greater Than','value' => '>','option' => NULL],
            ['id' => 5, 'name' => 'Contains','value' => 'JSON_CONTAINS','option' => '1'],
            ['id' => 6, 'name' => 'Not Contains','value' => 'JSON_CONTAINS','option' => '0']
        ];
        DB::table('predicates')->insert($predicates);
    }
}

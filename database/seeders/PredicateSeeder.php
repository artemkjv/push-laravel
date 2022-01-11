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
            ['id' => '1','name' => 'Is','value' => 'where','option' => '='],
            ['id' => '2','name' => 'Is Not','value' => 'where','option' => '!='],
            ['id' => '3','name' => 'Less Than','value' => 'where','option' => '<'],
            ['id' => '4','name' => 'Greater Than','value' => 'where','option' => '>'],
            ['id' => '5','name' => 'Contains','value' => 'whereJsonContains','option' => NULL],
            ['id' => '6','name' => 'Not Contains','value' => 'whereJsonDoesntContain','option' => NULL]
        ];
        DB::table('predicates')->insert($predicates);
    }
}

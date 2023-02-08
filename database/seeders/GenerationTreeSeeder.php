<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerationTreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('generation_trees')->insert([
            ['name' => 'Budi', 'gender' => 1, 'parent_id' => NULL],
            ['name' => 'Dedi', 'gender' => 1, 'parent_id' => 1],
            ['name' => 'Dodi', 'gender' => 1, 'parent_id' => 1],
            ['name' => 'Dede', 'gender' => 1, 'parent_id' => 1],
            ['name' => 'Dewi', 'gender' => 0, 'parent_id' => 1],
            ['name' => 'Feri', 'gender' => 1, 'parent_id' => 2],
            ['name' => 'Farah', 'gender' => 0, 'parent_id' => 2],
            ['name' => 'Gugus', 'gender' => 1, 'parent_id' => 3],
            ['name' => 'Gandi', 'gender' => 1, 'parent_id' => 3],
            ['name' => 'Hani', 'gender' => 0, 'parent_id' => 4],
            ['name' => 'Hana', 'gender' => 0, 'parent_id' => 4],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class PeopleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people_category')->insert(['name' => 'Для детей',  'active' => 1]);
        DB::table('people_category')->insert(['name' => 'МГН',  'active' => 1]);
        DB::table('people_category')->insert(['name' => 'Пожилые люди',  'active' => 1]);
    }
}

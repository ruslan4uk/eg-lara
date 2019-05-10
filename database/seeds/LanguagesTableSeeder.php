<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name' => 'Русский',
            'iso_code' => 'ru',
            'active' => 1,
        ]);
        DB::table('languages')->insert([
            'name' => 'Английский',
            'iso_code' => 'en',
            'active' => 1,
        ]);
        DB::table('languages')->insert([
            'name' => 'Чешский',
            'iso_code' => 'cz',
            'active' => 1,
        ]);
    }
}

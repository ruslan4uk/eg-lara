<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert(['name' => 'Рубль',  'active' => 1]);
        DB::table('currencies')->insert(['name' => 'Доллар',  'active' => 1]);
        DB::table('currencies')->insert(['name' => 'Евро',  'active' => 1]);
    }
}

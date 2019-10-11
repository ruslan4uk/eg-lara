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
        DB::table('currencies')->insert(['name' => 'Рубль', 'iso_code' => 'rubl-sign', 'active' => 1]);
        DB::table('currencies')->insert(['name' => 'Доллар', 'iso_code' => 'dollar-sign', 'active' => 1]);
        DB::table('currencies')->insert(['name' => 'Евро', 'iso_code' => 'euro-sign', 'active' => 1]);
    }
}

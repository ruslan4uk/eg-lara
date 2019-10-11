<?php

use Illuminate\Database\Seeder;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_type')->insert(['name' => 'С человека',  'active' => 1]);
        DB::table('price_type')->insert(['name' => 'С группы',  'active' => 1]);
    }
}

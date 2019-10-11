<?php

use Illuminate\Database\Seeder;

class TimingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timing')->insert(['name' => 'менее 1 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '1-2 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '2-3 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '3-4 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '4-5 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '5-6 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '6-7 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '7-8 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '8-9 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '9-10 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '10-11 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '11-12 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '12-13 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '13-14 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => '14-15 часа',  'active' => 1]);
        DB::table('timing')->insert(['name' => 'более 15 часов',  'active' => 1]);
    }
}

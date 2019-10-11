<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'Частный гид',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Туристическая компания/агентство',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Туроператор',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Шоппер',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Услуги перевода',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Фотограф',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Видео оператор',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Услуги трансфера',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Аренда авто',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Аренда яхты',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Организация торжеств',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Гастрономический гид',
            'active' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Инструктор',
            'active' => 1,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => 'Групповые экскурсии/туры',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Обзорные экскурсии/туры',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Авторские экскурсии/туры',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Гастрономические экскурсии/туры',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Экскурсии на автомобиле',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Пешеходные экскурсии',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Велотур/ велопоход',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Шопинг /шопинг тур',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Фотосессия',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Экскурсии по крыша',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Детские экскурсии/туры',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Паломничество',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Трансфер',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Круиз',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Квест',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Оздоровительный тур',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Восхождение в горы',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Дайвинг',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Джиппинг',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Йога тур',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Свадебная церемония',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Сноркелинг / снорклинг',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Экстрим',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Ночные экскурсии',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Полеты',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Музеи',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Достопримечательности',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Рыбалка',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Природа',  'active' => 1]);
        DB::table('categories')->insert(['name' => 'Морские/речные туры/экскурсии',  'active' => 1]);
    }
}

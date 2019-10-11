<?php

use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_type')->insert([
            'name' => 'Домашний',
            'active' => 1,
        ]);
        DB::table('contact_type')->insert([
            'name' => 'Рабочий',
            'active' => 1,
        ]);
        DB::table('contact_type')->insert([
            'name' => 'Skype',
            'active' => 1,
        ]);
        DB::table('contact_type')->insert([
            'name' => 'Telegram',
            'active' => 1,
        ]);
        DB::table('contact_type')->insert([
            'name' => 'Viber',
            'active' => 1,
        ]);
        DB::table('contact_type')->insert([
            'name' => 'WhatsApp',
            'active' => 1,
        ]);
    }
}

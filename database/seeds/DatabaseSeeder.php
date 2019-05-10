<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Users
        $this->call(UsersTableSeeder::class);

        // Languages
        $this->call(LanguagesTableSeeder::class);

        // Services
        $this->call(ServicesTableSeeder::class);
    }
}

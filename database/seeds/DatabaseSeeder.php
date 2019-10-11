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

        // ContactType
        $this->call(ContactTypeSeeder::class);

        // Category
        $this->call(CategorySeeder::class);

        // Currency
        $this->call(CurrencySeeder::class);

        // PeopleCategory
        $this->call(PeopleCategorySeeder::class);

        // PriceType
        $this->call(PriceTypeSeeder::class);

        // Timing
        $this->call(TimingSeeder::class);

    }
}

<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);

        // How many genres you need, defaulting to 10
        $count = (int)$this->command->ask('How many users do you need ?', 10);
        $this->command->info("Creating {$count} users.");
        // Create the Genre
        $users = factory(App\User::class, $count)->create();
        $this->command->info('Users Created!');

        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => 'rusel91@idz.ru',
        //     'password' => bcrypt('ruslan'),
        //     'about' => Str::random(200),
        //     'active' => 1,
        // ]);
    }
}

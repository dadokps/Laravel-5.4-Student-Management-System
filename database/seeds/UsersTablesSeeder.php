<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 2,
            'active' => 1,
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123'),
            'remember_token' => str_random(10)
        ]);
    }
}

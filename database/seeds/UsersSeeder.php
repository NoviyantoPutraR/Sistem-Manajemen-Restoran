<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'manager',
                'email' => 'manager@gmail.com',
                'role' => 'manager',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'employee',
                'email' => 'employee@gmail.com',
                'role' => 'employee',
                'password' => bcrypt('12345')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}

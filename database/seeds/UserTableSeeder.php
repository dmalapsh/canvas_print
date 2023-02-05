<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::count()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@domen.zo',
                'password' => bcrypt(1234),
                'role' => 'admin'
            ]);
        }
    }
}

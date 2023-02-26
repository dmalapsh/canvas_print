<?php

namespace Database\Seeders;

use App\Models\Access;
use Illuminate\Database\Seeder;

class AccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Access::create([
            'name' => 'admin_server',
            'access_template_id' => 1,
            'client_id' => 1,
            'data' => json_encode([
                'user' => 'user',
                'key' => '*some key*'
            ])
        ]);
        Access::create([
            'name' => 'bisness-bilain',
            'access_template_id' => 2,
            'client_id' => 1,
            'data' => json_encode([
                'login' => 'admin',
                'password' => '1334'
            ])
        ]);
    }
}

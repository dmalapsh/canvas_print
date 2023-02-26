<?php

namespace Database\Seeders;
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
        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(AccessTypeTableSeeder::class);
        $this->call(AccessTemplateTableSeeder::class);
        $this->call(AccessTableSeeder::class);
    }
}

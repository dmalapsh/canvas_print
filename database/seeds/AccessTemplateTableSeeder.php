<?php

namespace Database\Seeders;

use App\Models\AccessTemplate;
use Illuminate\Database\Seeder;

class AccessTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessTemplate::create([
            'name' => 'server csl',
            'access_type_id' => 1,
            'data' => json_encode([
                'host' => 'vsl.com:444',
                'user' => '%user%',
                'key' => [
                    'type' => 'rsa',
                    'value' => '%key%'
                ]
            ])
        ]);
        AccessTemplate::create([
            'name' => 'bilain',
            'access_type_id' => 2,
            'data' => json_encode([
                'url' => 'https://bilain.com',
                "steps" => [
                    [
                        "type" => "fillField",
                        "value" => "%login%",
                        "selector" => ".login"
                    ],
                    [
                        "type" => "fillField",
                        "value" => "%password%",
                        "selector" => ".pass"
                    ],
                    [
                        "type" => "click",
                        "selector" => ".btn"
                    ]
                ]
            ])
        ]);
    }
}

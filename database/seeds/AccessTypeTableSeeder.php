<?php

namespace Database\Seeders;

use App\Models\AccessType;
use Illuminate\Database\Seeder;

class AccessTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessType::create([
            'name' => 'ssh',
            'docs'=> '',
            'data' => json_encode([
                ['name' => 'host', 'type' => 'ifstring', 'condition' => '/((\d{1,3}\.){3}\d{1,3}|(\w+\.)*\w+)(:\d{1,5})?/'],
                ['name' => 'user', 'type' => 'string'],
                [
                    'name' => 'key',
                    'type' => 'object',
                    'contained' => [
                        ['name' => 'type', 'type' => 'enum', 'variants' => ['rsa', 'id545']],
                        ['name' => 'value', 'type' => 'string']
                    ]
                ]
            ]),
        ]);
        AccessType::create([
            "name" => "web",
            'docs'=> '',
            "data" => json_encode([
                [
                    "name" => "url",
                    "type" => "ifstring",
                    "condition" => '/^(https?:\/\/)((\w{2,255}\.)*\w{2,255})([-a-zA-Z0-9@:%_\+.~#?&\/=]*)$/'
                ],
                [
                    "name" => "steps",
                    "type" => "array",
                    "variants" => [
                        [
                            ["name" => "type", "type" => "ifstring", "condition" => '/^fillField$/'],
                            ["name" => "selector", "type" => "string"],
                            ["name" => "value", "type" => "string"]
                        ],
                        [
                            ["name" => "type", "type" => "ifstring", "condition" => '/^click$/'],
                            ["name" => "selector", "type" => "string"]
                        ]
                    ]
                ]
            ])
        ]);
    }
}

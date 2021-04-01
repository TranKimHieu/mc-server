<?php

use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    private $types = [
        [
            'id' => 1,
            'description' => 'By admin'
        ],
        [
            'id' => 2,
            'description' => 'By system'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $type) {
            DB::table('notification_types')->insert($type);
        }

    }
}

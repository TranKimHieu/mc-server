<?php

use Illuminate\Database\Seeder;

class TaskTypeSeeder extends Seeder
{
    private $types = [
        [
            'id' => 1,
            'name' => 'Task'
        ],
        [
            'id' => 2,
            'name' => 'Milestone'
        ],
        [
            'id' => 3,
            'name' => 'Project'
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
            DB::table('task_types')->insert($type);
        }

    }
}

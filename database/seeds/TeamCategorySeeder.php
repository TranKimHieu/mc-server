<?php

use Illuminate\Database\Seeder;

class TeamCategorySeeder extends Seeder
{
    private $categories = [
        [
            'id' => 1,
            'name' => 'Manager'
        ],
        [
            'id' => 2,
            'name' => 'Contract'
        ],
        [
            'id' => 3,
            'name' => 'Everyday'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            DB::table('team_categories')->insert($category);
        }
    }
}

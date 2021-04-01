<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private $roles = [
        [
            'id' => 1,
            'name' => 'Manager'
        ],
        [
            'id' => 2,
            'name' => 'Team Leader'
        ],
        [
            'id' => 3,
            'name' => 'Employee'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            DB::table('roles')->insert($role);
        }

    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'hieutk',
                'email' => 'hieutk@kaopiz.com',
                'password' => Hash::make('Admin@123'),
                'address' => 'bac ninh',
                'phone' => 123456789,
                'role_id' => \App\Enums\Roles::MANAGER
            ]
        ]);
    }
}

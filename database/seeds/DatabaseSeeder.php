<?php

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
         $this->call([
             NotificationTypeSeeder::class,
             RoleSeeder::class,
             TaskTypeSeeder::class,
             TeamCategorySeeder::class,
             UserSeeder::class,
         ]);
    }
}

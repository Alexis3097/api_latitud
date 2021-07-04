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
         $this->call(UserTypeSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(ExpenseTypeSeeder::class);
         $this->call(CheckTypeSeeder::class);
         $this->call(BoxSeeder::class);
    }
}

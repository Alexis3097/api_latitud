<?php

use App\Models\User;
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
        User::create([
            'user_type_id'=> 1,
            'name'=> 'Alexis admin',
            'email'=> 'admin@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);
        User::create([
            'user_type_id'=> 2,
            'name'=> 'cristian tecnico',
            'email'=> 'admin@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);
    }
}

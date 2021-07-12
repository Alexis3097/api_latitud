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
            'name'=> 'Giovana',
            'email'=> 'Giovana@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);
        User::create([
            'user_type_id'=> 3,
            'name'=> 'Ana',
            'email'=> 'Ana@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);
        User::create([
            'user_type_id'=> 2,
            'name'=> 'Gaby',
            'email'=> 'Gaby@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);
        User::create([
            'user_type_id'=> 3,
            'name'=> 'Alexis',
            'email'=> 'Alexis@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);
        User::create([
            'user_type_id'=> 3,
            'name'=> 'Manuel',
            'email'=> 'Manuel@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);
        User::create([
            'user_type_id'=> 3,
            'name'=> 'Dani',
            'email'=> 'Dani@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);

    }
}

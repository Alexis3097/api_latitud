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
            'name'=> 'Cristian Alexis',
            'last_name1'=>'Montoya',
            'last_name2'=>'Arguello',
            'email'=> 'admin@gmail.com',
            'password'=> Hash::make('adminadmin'),
            'photo'=> 'https://res.cloudinary.com/de2odpwpz/image/upload/v1629164104/ME_khizzl.jpg',
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
            'user_type_id'=> 4,
            'name'=> 'Alexis',
            'email'=> 'Alexis@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);
        User::create([
            'user_type_id'=> 4,
            'name'=> 'Manuel',
            'email'=> 'Manuel@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);
        User::create([
            'user_type_id'=> 4,
            'name'=> 'Dani',
            'email'=> 'Dani@gmail.com',
            'password'=> Hash::make('adminadmin'),
        ]);

    }
}

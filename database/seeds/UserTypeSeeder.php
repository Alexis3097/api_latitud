<?php

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1 admin
        UserType::create([
            'type'=>'Administrador'
        ]);
        //2 coordinador
        UserType::create([
            'type'=>'Coordinador'
        ]);
        //3 caja chica
        UserType::create([
            'type'=>'caja_chica'
        ]);
        //4 general
        UserType::create([
            'type'=>'General'
        ]);
    }
}

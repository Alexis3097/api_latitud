<?php

use App\Models\ExpenseType;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseType::create([
           "type"=>"Efectivo"
        ]);
        ExpenseType::create([
           "type"=>"Tarjeta"
        ]);
    }
}

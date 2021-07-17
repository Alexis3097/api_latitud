<?php

use App\Models\CashRegister;
use Illuminate\Database\Seeder;

class CashRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test =  AmountAssigned::create([
           'user_id'=>1,
           'amount'=>500,
           'amount_status'=>true,
        ]);
       $test->CashRegister()->create([
           'user_id' =>1,
           'account'=>500,
           'type'=>'pagado',
       ]);

    }
}

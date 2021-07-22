<?php

use App\Models\CashRegister;
use App\Models\Voucher;
use App\Models\AmountAssigned;
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
           'reason'=>'prueba de que jala uwu',
        ]);
       $test->CashRegister()->create([
           'account'=>500,
           'type'=>'pagado',
           'user_id'=>2
       ]);

       $test2 = Voucher::create([
           'user_id'=>2,
           'expense_type_id'=>1,
           'check_type_id'=>1,
           'concept'=>'test de registros',
           'amount'=>439,
           'photo'=>'my_photo.com',
           'photoId'=>'photoId',
           'Store'=>'fofel',
           'RFC'=>'larfc de la tienda'
       ]);

        $test2->CashRegister()->create([
            'account'=>1500,
            'type'=>'pagado',
            'user_id'=>3
        ]);

    }
}

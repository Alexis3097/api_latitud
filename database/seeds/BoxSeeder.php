<?php

use App\Models\Box;
use Illuminate\Database\Seeder;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Box::create([
            'amount'=>'700',
            'user_id'=>2,
        ]);
        Box::create([
            'amount'=>'800',
            'user_id'=>3,
        ]);
        Box::create([
            'amount'=>'5800',
            'user_id'=>4,
        ]);

    }
}

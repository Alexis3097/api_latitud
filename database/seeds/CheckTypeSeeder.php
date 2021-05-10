<?php

use App\Models\CheckType;
use Illuminate\Database\Seeder;

class CheckTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CheckType::create([
            "type"=>"Ticket"
        ]);
        CheckType::create([
            "type"=>"Factura"
        ]);
    }
}

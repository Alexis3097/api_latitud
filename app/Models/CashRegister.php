<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    protected $table = 'cash_register';

    protected $fillable = [
        'box_id',
        'last_amount',
        'now_amount',
    ];
}

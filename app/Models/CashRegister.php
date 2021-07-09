<?php

namespace App\Models;
use App\Models\Box;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    protected $table = 'cash_register';

    protected $fillable = [
        'box_id',
        'last_amount',
        'account',
        'now_amount',
    ];

    protected $appends = [
        'user',
    ];


    public function box()
    {
        return $this->belongsTo(Box::class);
    }
    public function getUserAttribute(){
        return $this->box();
    }
}

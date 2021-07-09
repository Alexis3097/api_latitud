<?php

namespace App\Models;

use App\Models\CashRegister;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Box extends Model
{
    protected $table = 'box';

    protected $fillable = [
        'amount',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cashRegisters()
    {
        return $this->hasMany(CashRegister::class);
    }
}

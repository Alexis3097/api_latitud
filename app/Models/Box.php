<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CashRegister;
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

    public function cashRegister(){
        return $this->hasOne(CashRegister::class);
    }
}

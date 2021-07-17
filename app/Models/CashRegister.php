<?php

namespace App\Models;
use App\Models\Box;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashRegister extends Model
{
    protected $table = 'cash_register';
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'account',
        'type',
        'registrable_id',
        'registrable_type',
    ];

//    protected $appends = [
//        'user',
//    ];


    public function box()
    {
        return $this->belongsTo(Box::class);
    }
//    public function getUserAttribute(){
//        return $this->box->user;
//    }
    //relacion polimorfica
    public function registrable()
    {
        return $this->morphTo();
    }



}

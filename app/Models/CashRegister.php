<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashRegister extends Model
{
    protected $table = 'cash_register';
    use SoftDeletes;
    protected $fillable = [
        'account',
        'type',
        'registrable_id',
        'registrable_type',
        'user_id',
    ];

    //relacion polimorfica
    public function registrable()
    {
        return $this->morphTo();
    }

    public function getUserAttribute(){
        return $this->registrable->user;
    }
    protected $appends = [
    'user'
    ];
    function user(){
        return $this->belongsTo(User::class);
    }

}

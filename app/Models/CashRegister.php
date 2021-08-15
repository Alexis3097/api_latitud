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

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = '2021-08-20';
    }

    //relacion polimorfica
    public function registrable()
    {
        return $this->morphTo();
    }


    protected $appends = [
        'Sender',
        'Receiver'
    ];
    function user(){
        return $this->belongsTo(User::class);
    }

    public function getSenderAttribute(){
        return $this->registrable->user;
    }

    function getReceiverAttribute(){
        return $this->user;
    }

}

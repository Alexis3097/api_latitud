<?php

namespace App\Models;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashRegister extends Model
{
    protected $table = 'cash_register';
    use SoftDeletes;
    protected $fillable = [
        'account',
        'type',
        'user_id',
        'registrable_id',
        'registrable_type',
        'idDestination',
    ];

    public function getCreatedAtAttribute($value)
    {
        return  Carbon::parse($value)->setTimezone('America/Mexico_City')->format('Y-m-d H:i:s.u');
    }

    //relacion polimorfica
    public function registrable()
    {
        return $this->morphTo();
    }


    protected $appends = [
        'Sender',
        'Receiver',
    ];
    function user(){
        return $this->belongsTo(User::class, 'idDestination');
    }

    public function getSenderAttribute(){
        return $this->registrable->user;
    }

    function getReceiverAttribute(){
        return $this->user;
    }




}

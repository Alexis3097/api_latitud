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
        'registrable_id',
        'registrable_type',
        'user_id',
    ];



    //relacion polimorfica
    public function registrable()
    {
        return $this->morphTo();
    }


    protected $appends = [
        'Sender',
        'Receiver',
        'Fecha'
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

    function  getFechaAttribute(){
//        $timestamp = '2020-06-06 20:20:00';
//        $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'Europe/Stockholm');
//        $date->setTimezone('UTC');
        return  Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s.u');
    }

}

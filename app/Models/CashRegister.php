<?php

namespace App\Models;
use App\Models\Box;
use App\Models\User;
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
        'Date',
    ];


    public function box()
    {
        return $this->belongsTo(Box::class);
    }
    public function getUserAttribute(){
        return $this->box->user;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['created_at'] =$value->format('l jS \\of F Y h:i:s A');
    }


}

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
        'user_id',
        'account',
        'type',
        'registrable_id',
        'registrable_type',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relacion polimorfica
    public function registrable()
    {
        return $this->morphTo();
    }

    public function getRelacionAttribute(){
        return $this->registrable->user_id;
    }
    protected $appends = [
    'Relacion'
    ];

}

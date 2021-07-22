<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Models\UserType;
use App\Models\AmountAssigned;
use App\Models\CashRegister;
use App\Models\Box;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
//    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id',
        'name',
        'last_name1',
        'last_name2',
        'photo',
        'email',
        'password',
        'job',
        'date_of_birth',
    ];

    public function userType(){
        return $this->belongsTo(UserType::class);
    }

    public function amountAssigned(){
        return $this->hasOne(AmountAssigned::class);
    }
    public function voucher(){
        return $this->hasOne(Voucher::class);
    }

    public function box(){
        return $this->hasOne(Box::class);
    }
    public function cashRegisters(){
        return $this->hasMany(CashRegister::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $appends = [

    ];




}

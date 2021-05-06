<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmountAssigned extends Model
{
    protected $table = 'amount_assigned';
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','amount','amount_status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function voucher(){
        return $this->hasOne(Voucher::class);
    }
}

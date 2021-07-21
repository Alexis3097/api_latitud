<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Voucher;
use App\Models\CashRegister;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static paginate(int $int)
 */
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
        'user_id','amount','reason','amount_status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function cashRegister()
    {
        return $this->morphOne(CashRegister::Class, 'registrable');
    }
}

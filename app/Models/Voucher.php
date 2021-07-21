<?php

namespace App\Models;

use App\Models\CashRegister;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AmountAssigned;
use App\Models\ExpenseType;
use App\Models\CheckType;

/**
 * @method static paginate(int $int)
 * @method static create($data)
 * @method static find($id)
 */
class Voucher extends Model
{
    use SoftDeletes;
    protected $table = 'vouchers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
//        'amount_assigned_id',
        'expense_type_id',
        'check_type_id',
        'concept',
        'amount',
        'photo',
        'Store',
        'RFC',
    ];

    public function amountAssigned(){
        return $this->belongsTo(AmountAssigned::class);
    }

    public function expenseType(){
        return $this->belongsTo(ExpenseType::class);
    }

    public function checkType(){
        return $this->belongsTo(CheckType::class);
    }

    public function CashRegister()
    {
        return $this->morphOne(CashRegister::Class, 'registrable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

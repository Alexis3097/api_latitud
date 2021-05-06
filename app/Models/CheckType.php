<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher;
class CheckType extends Model
{
    protected $table = 'check_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
    ];

    public function voucher(){
        return $this->hasOne(Voucher::class);
    }
}

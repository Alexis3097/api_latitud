<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Box extends Model
{
    protected $table = 'box';

    protected $fillable = [
        'amount',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

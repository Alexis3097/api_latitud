<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'box';

    protected $fillable = [
        'amount',
        'user_id',
    ];
}

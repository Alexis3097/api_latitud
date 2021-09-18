<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    protected $table = 'notifications';
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'destination_id',
        'type',
        'is_read',
        'register_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

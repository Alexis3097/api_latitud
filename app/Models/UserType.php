<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
class UserType extends Model
{
    protected $table = 'user_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }
}

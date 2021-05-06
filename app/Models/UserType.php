<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
class UserType extends Model
{
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static paginate(int $int)
 * @method static find(int $int)
 * @method static create($data)
 */
class Test extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'age', 'last_name',
    ];
}

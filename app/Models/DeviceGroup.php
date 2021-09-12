<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\NotificationToken;
class DeviceGroup extends Model
{
    protected $table = 'device_groups';
    protected $fillable = [
        'user_id',
        'notification_key_name',
        'notification_key',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notificationToken()
    {
        return $this->hasMany(NotificationToken::class);
    }
}

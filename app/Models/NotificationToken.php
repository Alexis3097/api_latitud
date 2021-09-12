<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DeviceGroup;
class NotificationToken extends Model
{
    protected $table = 'notification_tokens';
    protected $fillable = [
        'device_groups_id',
        'token',
    ];
    public function deviceGroup()
    {
        return $this->belongsTo(DeviceGroup::class);
    }

}

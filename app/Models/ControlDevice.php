<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControlDevice extends Model
{
    protected $primaryKey = 'device_id';

    protected $fillable = [
        'user_id', 'device_type', 'description',
    ];

    /**
     * Get the user that owns the control device.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the control device statuses for the control device.
     */
    public function controlDeviceStatuses()
    {
        return $this->hasMany(ControlDeviceStatus::class);
    }
}

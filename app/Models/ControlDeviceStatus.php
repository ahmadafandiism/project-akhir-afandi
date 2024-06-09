<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControlDeviceStatus extends Model
{
    protected $primaryKey = 'status_id';

    protected $fillable = [
        'device_id', 'status_time', 'status',
    ];

    /**
     * Get the control device that owns the status.
     */
    public function controlDevice()
    {
        return $this->belongsTo(ControlDevice::class);
    }
}

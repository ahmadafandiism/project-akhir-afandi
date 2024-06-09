<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'user_id', 'sensor_id', 'send_time', 'notification_type',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the sensor that triggered the notification.
     */
    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}

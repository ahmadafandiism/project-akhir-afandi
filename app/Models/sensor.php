<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $primaryKey = 'sensor_id';

    protected $fillable = [
        'user_id', 'sensor_type', 'description',
    ];

    /**
     * Get the user that owns the sensor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the sensor readings for the sensor.
     */
    public function sensorReadings()
    {
        return $this->hasMany(SensorReading::class);
    }
}

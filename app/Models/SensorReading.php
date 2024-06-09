<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorReading extends Model
{
    protected $primaryKey = 'reading_id';

    protected $fillable = [
        'sensor_id', 'reading_time', 'value',
    ];

    /**
     * Get the sensor that owns the reading.
     */
    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}

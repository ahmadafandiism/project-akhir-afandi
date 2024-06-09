<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorReading;

class SensorReadingController extends Controller
{
    /**
     * Display a listing of the sensor readings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensorReadings = SensorReading::all();
        return response()->json($sensorReadings, 200);
    }

    /**
     * Store a newly created sensor reading in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sensor_id' => 'required|exists:sensors,id',
            'reading_time' => 'required|date',
            'value' => 'required|numeric',
        ]);

        $sensorReading = SensorReading::create($request->all());

        return response()->json($sensorReading, 201);
    }

    /**
     * Display the specified sensor reading.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sensorReading = SensorReading::findOrFail($id);
        return response()->json($sensorReading, 200);
    }

    /**
     * Update the specified sensor reading in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sensor_id' => 'required|exists:sensors,id',
            'reading_time' => 'required|date',
            'value' => 'required|numeric',
        ]);

        $sensorReading = SensorReading::findOrFail($id);
        $sensorReading->update($request->all());

        return response()->json($sensorReading, 200);
    }

    /**
     * Remove the specified sensor reading from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sensorReading = SensorReading::findOrFail($id);
        $sensorReading->delete();

        return response()->json(null, 204);
    }
}

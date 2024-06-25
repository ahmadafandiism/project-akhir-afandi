<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorDataController extends Controller
{
    public function store(Request $request)
    {
        $sensorData = new SensorData();
        $sensorData->temperature = $request->input('temperature');
        $sensorData->humidity = $request->input('humidity');
        $sensorData->mq2 = $request->input('mq2');
        $sensorData->rain = $request->input('rain');
        $sensorData->save();

        return response()->json(['message' => 'Data saved successfully'], 200);
    }

    public function getData()
{
    $sensorData = SensorData::latest()->take(10)->get();
    return response()->json($sensorData);
}

}

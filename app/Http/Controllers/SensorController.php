<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::all();
        return response()->json($sensors);
    }

    public function show($id)
    {
        $sensor = Sensor::findOrFail($id);
        return response()->json($sensor);
    }

    public function store(Request $request)
    {
        $sensor = Sensor::create($request->all());
        return response()->json($sensor, 201);
    }

    public function update(Request $request, $id)
    {
        $sensor = Sensor::findOrFail($id);
        $sensor->update($request->all());
        return response()->json($sensor, 200);
    }

    public function destroy($id)
    {
        $sensor = Sensor::findOrFail($id);
        $sensor->delete();
        return response()->json(null, 204);
    }
}

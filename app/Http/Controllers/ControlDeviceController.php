<?php

namespace App\Http\Controllers;

use App\Models\ControlDevice;
use Illuminate\Http\Request;

class ControlDeviceController extends Controller
{
    public function index()
    {
        $controlDevices = ControlDevice::all();
        return response()->json($controlDevices);
    }

    public function show($id)
    {
        $controlDevice = ControlDevice::findOrFail($id);
        return response()->json($controlDevice);
    }

    public function store(Request $request)
    {
        $controlDevice = ControlDevice::create($request->all());
        return response()->json($controlDevice, 201);
    }

    public function update(Request $request, $id)
    {
        $controlDevice = ControlDevice::findOrFail($id);
        $controlDevice->update($request->all());
        return response()->json($controlDevice, 200);
    }

    public function destroy($id)
    {
        $controlDevice = ControlDevice::findOrFail($id);
        $controlDevice->delete();
        return response()->json(null, 204);
    }
}

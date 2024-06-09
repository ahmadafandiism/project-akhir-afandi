<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ControlDeviceStatus;

class ControlDeviceStatusController extends Controller
{
    /**
     * Display a listing of the control device statuses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controlDeviceStatuses = ControlDeviceStatus::all();
        return response()->json($controlDeviceStatuses, 200);
    }

    /**
     * Store a newly created control device status in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:control_devices,id',
            'status_time' => 'required|date',
            'status' => 'required|boolean',
        ]);

        $controlDeviceStatus = ControlDeviceStatus::create($request->all());

        return response()->json($controlDeviceStatus, 201);
    }

    /**
     * Display the specified control device status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $controlDeviceStatus = ControlDeviceStatus::findOrFail($id);
        return response()->json($controlDeviceStatus, 200);
    }

    /**
     * Update the specified control device status in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'device_id' => 'required|exists:control_devices,id',
            'status_time' => 'required|date',
            'status' => 'required|boolean',
        ]);

        $controlDeviceStatus = ControlDeviceStatus::findOrFail($id);
        $controlDeviceStatus->update($request->all());

        return response()->json($controlDeviceStatus, 200);
    }

    /**
     * Remove the specified control device status from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $controlDeviceStatus = ControlDeviceStatus::findOrFail($id);
        $controlDeviceStatus->delete();

        return response()->json(null, 204);
    }
}

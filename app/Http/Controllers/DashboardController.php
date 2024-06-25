<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class DashboardController extends Controller
{
    public function index()
    {
        $sensorData = SensorData::latest()->take(20)->get();
        return view('dashboard', compact('sensorData'));
    }
}

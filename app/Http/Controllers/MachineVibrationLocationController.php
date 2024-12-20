<?php

namespace App\Http\Controllers;

use App\Models\MachineVibrationLocations;
use Illuminate\Http\Request;

class MachineVibrationLocationController extends Controller
{
    public function fetchMachineVibrationLocation(Request $request)
    {
        $vibrationLocations = MachineVibrationLocations::where('machine_id', $request->query('id'))->get();
        return response()->json(['vibrationLocations' => $vibrationLocations]);
    }
}

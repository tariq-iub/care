<?php

namespace App\Http\Controllers;

use App\Models\MachineVibrationLocation;
use Illuminate\Http\Request;

class MachineVibrationLocationController extends Controller
{
    public function fetchByMachine($machineId)
    {
        $vibrationLocations = MachineVibrationLocation::where('machine_id', $machineId)->get();
        return response()->json(['vibrationLocations' => $vibrationLocations]);
    }
}

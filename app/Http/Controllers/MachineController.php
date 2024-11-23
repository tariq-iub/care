<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\MachineInfo;
use App\Models\MachineProcessPoint;
use App\Models\MachineVibrationLocations;
use App\Models\MidSetup;
use App\Models\Plant;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
    {
        $machines = MachineInfo::with('midSetup', 'plant', 'area')->get();

        return view('admin.machine.index', compact('machines'));
    }

    public function create()
    {
        $mids = MidSetup::with('answers')->get();
        $plants = Plant::all();
        $areas = Area::all();

        $locations = [
            ['location_name' => 'Location 1', 'position' => '1', 'id_tag' => 'location_1', 'orientation' => getOrientationsType()],
            ['location_name' => 'Location 2', 'position' => '2', 'id_tag' => 'location_2', 'orientation' => getOrientationsType()],
            ['location_name' => 'Location 3', 'position' => '3', 'id_tag' => 'location_3', 'orientation' => getOrientationsType()],
            ['location_name' => 'Location 4', 'position' => '4', 'id_tag' => 'location_4', 'orientation' => getOrientationsType()],
        ];

        return view('admin.machine.create', compact('mids', 'plants', 'areas', 'locations'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $info = $data['info'];
        $locationVibrations = $data['locationVibrations'];
        $processPoints = $data['processPoints'];

        $machine_info = MachineInfo::create([
            'mid_setup_id' => $data['mid_setup_id'],
            'plant_id' => $info['plantName'],
            'area_id' => $info['areaName'],
            'machine_name' => $info['machineName'],
        ]);

        if (isset($locationVibrations['isVibrationLocationChecked']) && $locationVibrations['isVibrationLocationChecked']) {
            foreach ($locationVibrations['locations'] as $location) {
                $machine_vibration_location = MachineVibrationLocations::create([
                    'machine_info_id' => $machine_info->id,
                    'location_name' => $location['locationName'],
                    'position' => $location['position'],
                    'id_tag' => $location['idTag'],
                    'orientation' => $location['orientation'],
                ]);
            }
        }

        if ($processPoints['isProcessPointsChecked']) {
            foreach ($processPoints['points'] as $point) {
                $machine_process_point = MachineProcessPoint::create([
                    'machine_info_id' => $machine_info->id,
                    'point_name' => $point['pointName'],
                    'id_tag' => $point['idTag'],
                ]);
            }
        }

        return response()->json(['success' => true,]);
    }

    public function destroy($id)
    {
        $machine = MachineInfo::find($id);

        $vibrationLocations = MachineVibrationLocations::where('machine_info_id', $id)->get();
        $processPoints = MachineProcessPoint::where('machine_info_id', $id)->get();

        foreach ($vibrationLocations as $vibrationLocation) {
            $vibrationLocation->delete();
        }

        foreach ($processPoints as $processPoint) {
            $processPoint->delete();
        }

        $machine->delete();
        return redirect()->route('machines.index')->with('success', 'Machine deleted successfully');

    }
}

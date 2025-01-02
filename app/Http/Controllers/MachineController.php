<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Machine;
use App\Models\MachineProcessPoint;
use App\Models\MachineVibrationLocations;
use App\Models\MidSetup;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::with('midSetup', 'plant', 'area')->get();

        return view('admin.machine.index', compact('machines'));
    }

    public function edit($id)
    {
        $machine = Machine::with('midSetup', 'plant', 'area')->find($id);
        $mids = MidSetup::with('answers')->get();
        $plants = Plant::all();
        $areas = Area::all();

        $isVibrationLocationChecked =null;

        $locations = MachineVibrationLocations::where('machine_id', $id)->get();
        foreach ($locations as $location) {
            $location->orientations = getOrientationsType();
            $isVibrationLocationChecked = $location->is_locations_enabled;
        }
        $processPoints = MachineProcessPoint::where('machine_id', $id)->get();

        $isProcessPointsChecked = null;
        foreach ($processPoints as $processPoint) {
            $isProcessPointsChecked = $processPoint->is_points_enabled;
        }

        return view('admin.machine.edit', compact('machine', 'mids', 'plants', 'areas', 'locations', 'processPoints', 'isVibrationLocationChecked', 'isProcessPointsChecked'));
    }

    public function show($id)
    {
        $machine = Machine::with('midSetup', 'plant', 'area')->find($id);
        $mids = MidSetup::with('answers')->get();
        $plants = Plant::all();
        $areas = Area::all();

        $isVibrationLocationChecked =null;

        $locations = MachineVibrationLocations::where('machine_id', $id)->get();
        foreach ($locations as $location) {
            $location->orientations = getOrientationsType();
            $isVibrationLocationChecked = $location->is_locations_enabled;
        }
        $processPoints = MachineProcessPoint::where('machine_id', $id)->get();

        $isProcessPointsChecked = null;
        foreach ($processPoints as $processPoint) {
            $isProcessPointsChecked = $processPoint->is_points_enabled;
        }

        return view('admin.machine.show', compact('machine', 'mids', 'plants', 'areas', 'locations', 'processPoints', 'isVibrationLocationChecked', 'isProcessPointsChecked'));
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

        $machine_info = Machine::create([
            'mid_setup_id' => $data['mid_setup_id'],
            'plant_id' => $info['plantName'],
            'area_id' => $info['areaName'],
            'machine_name' => $info['machineName'],
        ]);

        if (isset($locationVibrations['isVibrationLocationChecked'])) {
            foreach ($locationVibrations['locations'] as $location) {
                $machine_vibration_location = MachineVibrationLocations::create([
                    'machine_id' => $machine_info->id,
                    'is_locations_enabled' => $locationVibrations['isVibrationLocationChecked'] ? 1 : 0,
                    'location_name' => $location['locationName'],
                    'position' => $location['position'],
                    'id_tag' => $location['idTag'],
                    'orientation' => $location['orientation'],
                ]);
            }
        }

        if (isset($processPoints['isProcessPointsChecked'])) {
            foreach ($processPoints['points'] as $point) {
                $machine_process_point = MachineProcessPoint::create([
                    'machine_id' => $machine_info->id,
                    'is_points_enabled' => $processPoints['isProcessPointsChecked'] ? 1 : 0,
                    'point_name' => $point['pointName'],
                    'id_tag' => $point['idTag'],
                ]);
            }
        }

        return response()->json(['success' => true,]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $info = $data['info'];
        $locationVibrations = $data['locationVibrations'];
        $processPoints = $data['processPoints'];

        $machine_info = Machine::find($id);
        $machine_info->update([
            'mid_setup_id' => $data['mid_setup_id'],
            'plant_id' => $info['plantName'],
            'area_id' => $info['areaName'],
            'machine_name' => $info['machineName'],
        ]);

        if (isset($locationVibrations['isVibrationLocationChecked'])) {
            foreach ($locationVibrations['locations'] as $location) {
                $machine_vibration_location = MachineVibrationLocations::find($location['id']);
                $machine_vibration_location->update([
                    'machine_id' => $machine_info->id,
                    'is_locations_enabled' => $locationVibrations['isVibrationLocationChecked'] ? 1 : 0,
                    'location_name' => $location['locationName'],
                    'position' => $location['position'],
                    'id_tag' => $location['idTag'],
                    'orientation' => $location['orientation'],
                ]);
            }
        }

        if (isset($processPoints['isProcessPointsChecked'])) {
            foreach ($processPoints['points'] as $point) {
                $machine_process_point = MachineProcessPoint::find($point['id']);
                $machine_process_point->update([
                    'machine_id' => $machine_info->id,
                    'is_points_enabled' => $processPoints['isProcessPointsChecked'] ? 1 : 0,
                    'point_name' => $point['pointName'],
                    'id_tag' => $point['idTag'],
                ]);
            }
        }
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $machine = Machine::find($id);

        $vibrationLocations = MachineVibrationLocations::where('machine_id', $id)->get();
        $processPoints = MachineProcessPoint::where('machine_id', $id)->get();

        foreach ($vibrationLocations as $vibrationLocation) {
            $vibrationLocation->delete();
        }

        foreach ($processPoints as $processPoint) {
            $processPoint->delete();
        }

        $machine->delete();
        return redirect()->route('machines.index')->with('success', 'Machine deleted successfully');

    }

    public function fetchByArea($areaId)
    {
        $machines = Machine::where('area_id', $areaId)->get();
        return response()->json(['machines' => $machines]);
    }
}

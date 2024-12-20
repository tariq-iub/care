<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Company;
use App\Models\Plant;
use App\Models\PlantServiceRep;
use App\Models\ServiceRepresentative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlantController extends Controller
{
    public function index($company)
    {
        $plants = Plant::where('company_id', $company)->get();

        return view('admin.plants.plant-index', compact('plants', 'company'));
    }

    public function create($company_id)
    {
        $serviceReps = ServiceRepresentative::all();

        return view('admin.plants.plant-create', compact('company_id', 'serviceReps'));
    }

    public function edit(Plant $plant)
    {
        $note = $plant->note;
        $serviceRepsAll = ServiceRepresentative::all();
        $plantServiceReps = PlantServiceRep::where('plant_id', $plant->id)->get(); //  get all service reps for the plant that are already assigned
        $serviceReps = [];
        foreach ($plantServiceReps as $plantServiceRep) {
            $serviceReps[] = ServiceRepresentative::where('id', $plantServiceRep->service_rep_id)->first();
        }

        foreach ($serviceReps as $serviceRep) {
            foreach ($serviceRepsAll as $key => $serviceRepAll) {
                if ($serviceRep->id == $serviceRepAll->id) {
                    unset($serviceRepsAll[$key]);
                }
            }
        }

        return view('admin.plants.plant-edit', compact('plant', 'serviceReps', 'note', 'serviceRepsAll'));
    }

//    public function show(Plant $plant)
//    {
//        $note = $plant->note;
//        $plantServiceReps = PlantServiceRep::where('plant_id', $plant->id)->get();
//        $serviceReps= [];
//        foreach($plantServiceReps as $plantServiceRep) {
//            $serviceReps[] = ServiceRepresentative::where('id', $plantServiceRep->service_rep_id)->first();
//        }
//
//        return view('admin.plants.plant-show', compact('plant', 'serviceReps', 'note'));
//    }

    public function savePlantInfo(Request $request)
    {
        // Validate the request
        $validator = $request->validate([
            'plant_name' => 'required|string|max:255',
            'company_id' => 'required|integer',
            'plant_status' => 'required|string|max:255',
        ]);

        // Save the company information
        $plant = Plant::updateOrCreate(
            ['id' => $request->input('plant_id')],
            [
                'title' => $validator['plant_name'],
                'company_id' => $validator['company_id'],
                'status' => $validator['plant_status'],
            ]
        );

        return response()->json(['success' => true, 'plant' => $plant]);
    }

    public function updatePlantInfo(Request $request)
    {
        $plant = Plant::where('id', $request->input('plant_id'))->firstOrFail();

        $validator = $request->validate([
            'plant_name' => 'required|string|max:255',
            'plant_status' => 'required|string|max:255',
        ]);

        $plant->title = $validator['plant_name'];
        $plant->status = $validator['plant_status'];
        $plant->save();

        return response()->json(['success' => true, 'plant' => $plant]);
    }

    public function showPlants(Request $request, $company_id)
    {

        $plant = Plant::where('id', $company_id)->firstOrFail();
        $areas = Area::where('plant_id', $company_id)->get();

        return view('admin.plants.partial.handlers_table', compact('plant', 'areas', 'company_id'));
    }

    public function showPlant(Request $request, $id)
    {
        $plant = Plant::where('id', $id)->firstOrFail();
        $note = $plant->note;
        $plantServiceRep = PlantServiceRep::where('plant_id', $id)->get();
        $serviceReps = [];

        foreach ($plantServiceRep as $plantServiceReps) {
            $serviceReps[] = ServiceRepresentative::where('id', $plantServiceReps->service_rep_id)->first();
        }

        return response()->json([
            'success' => true,
            'plant' => $plant,
            'note' => $note,
            'serviceReps' => $serviceReps
        ]);
    }

    public function fetchPlants(Request $request)
    {
        $plants = Plant::all();
        return response()->json(['plants' => $plants]);
    }
}

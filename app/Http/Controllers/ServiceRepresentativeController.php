<?php

namespace App\Http\Controllers;

use App\Models\PlantServiceRep;
use App\Models\ServiceRepresentative;
use Illuminate\Http\Request;

class ServiceRepresentativeController extends Controller
{
    public function index()
    {
        $service_reps = ServiceRepresentative::all();

        return view('admin.service_representative.index', compact('service_reps'));
    }

    public function create()
    {
        return view('admin.service_representative.create');
    }

    public function edit($id)
    {
        $service_rep = ServiceRepresentative::findOrFail($id);
        return view('admin.service_representative.edit', compact('service_rep'));
    }

    public function show($id)
    {
        $service_rep = ServiceRepresentative::all()->find($id);
        return view('admin.service_representative.show', compact('service_rep'));
    }

    public function saveServiceRepresentative(Request $request)
    {
        // Validate the request
        $validator = $request->validate([
            'plant_id' => 'required|integer',
            'service_rep_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'alt_phone_number' => 'nullable|string|max:15',
            'fax_number' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        // Save service rep information
        $serviceRep = ServiceRepresentative::updateOrCreate(
            ['id' => $request->input('service_rep_id'),
                'service_rep_name' => $validator['service_rep_name'],
                'address' => $validator['address'],
                'city' => $validator['city'],
                'state' => $validator['state'],
                'zip' => $validator['zip'],
                'country' => $validator['country'],
                'contact_name' => $validator['contact_name'],
                'contact_title' => $validator['contact_title'],
                'phone_number' => $validator['phone_number'],
                'alt_phone_number' => $validator['alt_phone_number'],
                'fax_number' => $validator['fax_number'],
                'email' => $validator['email'],
            ],
        );

        $plantServiceRep = PlantServiceRep::updateOrCreate(
            ['plant_id' => $validator['plant_id'],
                'service_rep_id' => $serviceRep->id,
            ],
        );

        return response()->json(['success' => true, 'serviceRep' => $serviceRep, 'plantServiceRep' => $plantServiceRep]);
    }
    function updateServiceRepresentative(Request $request)
    {
        $serviceRep = ServiceRepresentative::where('id', $request->input('service_rep_id'))->firstOrFail();

        $validator = $request->validate([
            'service_rep_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'alt_phone_number' => 'nullable|string|max:15',
            'fax_number' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $serviceRep->update([
            'service_rep_name' => $validator['service_rep_name'],
            'address' => $validator['address'],
            'city' => $validator['city'],
            'state' => $validator['state'],
            'zip' => $validator['zip'],
            'country' => $validator['country'],
            'contact_name' => $validator['contact_name'],
            'contact_title' => $validator['contact_title'],
            'phone_number' => $validator['phone_number'],
            'alt_phone_number' => $validator['alt_phone_number'],
            'fax_number' => $validator['fax_number'],
            'email' => $validator['email'],
        ]);

        return response()->json(['success' => true, 'serviceRep' => $serviceRep]);
    }

    public function linkServiceRepresentative(Request $request)
    {
        $validator = $request->validate([
            'plant_id' => 'required|integer',
            'service_rep_ids' => 'required|array',
        ]);

        foreach ($validator['service_rep_ids'] as $service_rep_id) {
            $plantServiceRep = PlantServiceRep::updateOrCreate(
                ['plant_id' => $validator['plant_id'],
                    'service_rep_id' => $service_rep_id,
                ],
            );
        }
        return response()->json(['success' => true,]);
    }

    public function fetchServiceRepresentative(Request $request, $id)
    {
        $serviceRep = ServiceRepresentative::where('id', $id)->firstOrFail();
        return response()->json(['success' => true, 'serviceRep' => $serviceRep]);
    }

    public function fetchPlantServiceRepresentative(Request $request, $id)
    {
        $serviceRepsAll = ServiceRepresentative::all()->toArray();
        $plantServiceReps = PlantServiceRep::where('plant_id', $id)->get();
        $serviceReps = [];

        foreach ($plantServiceReps as $plantServiceRep) {
            $serviceReps[] = ServiceRepresentative::where('id', $plantServiceRep->service_rep_id)->first();
        }

        $serviceRepsAll =array_values($serviceRepsAll);

        return response()->json(['success' => true, 'serviceReps' => $serviceReps, 'serviceRepsAll' => $serviceRepsAll]);
    }
}

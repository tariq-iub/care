<?php

namespace App\Http\Controllers;

use App\Models\PlantServiceRep;
use App\Models\ServiceRepresentative;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceRepresentativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service_reps = ServiceRepresentative::all();

        return view('admin.service_representative.index', compact('service_reps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service_representative.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_rep_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20',
            'alt_phone_number' => 'nullable|string|max:20',
            'fax_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        ServiceRepresentative::create($request->all());

        return redirect()->route('service-reps.index')
            ->with('success', 'Service Representative created successfully.');
    }

    public function saveServiceRepresentative(Request $request)
    {
        // Validate the request
        $validator = $request->validate([
            'plant_id' => 'required|integer',
        ]);
        $request->validate([
            'service_rep_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20',
            'alt_phone_number' => 'nullable|string|max:20',
            'fax_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        ServiceRepresentative::create($request->all());

        return redirect()->route('service-reps.index')
            ->with('success', 'Service Representative created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {

        $validator = $request->validate([
            'plant_id' => 'required|integer',
            'service_rep_id' => 'required|integer',
        ]);

        $serviceRepresentative = ServiceRepresentative::findOrFail($id);
        $plantServiceRep = PlantServiceRep::updateOrCreate(
            ['plant_id' => $validator['plant_id'],
                'service_rep_id' => $serviceRepresentative->id,
            ],
        );

        return response()->json(['success' => true, 'serviceRep' => $serviceRepresentative, 'plantServiceRep' => $plantServiceRep]);
        return view('admin.service_representative.show', compact('serviceRepresentative'));
    }
    function updateServiceRepresentative(Request $request){}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
//        $serviceRep = ServiceRepresentative::where('id', $request->input('service_rep_id'))->firstOrFail();
        $serviceRepresentative = ServiceRepresentative::findOrFail($id);

//        $validator = $request->validate([]);
        return view('admin.service_representative.edit', compact('serviceRepresentative'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'service_rep_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20',
            'alt_phone_number' => 'nullable|string|max:20',
            'fax_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $serviceRepresentative = ServiceRepresentative::findOrFail($id);
        $serviceRepresentative->update($request->all());

        return redirect()->route('service-reps.index')
            ->with('success', 'Service Representative updated successfully.');
        return response()->json(['success' => true, 'serviceRep' => $serviceRep]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $serviceRepresentative = ServiceRepresentative::findOrFail($id);
        $serviceRepresentative->delete();

        return redirect()->route('service-reps.index')
            ->with('success', 'Service Representative deleted successfully.');
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

    public function checkEmail($email){
        $exists = User::where('email', $email)->exists();
        if ($exists) {
            return response()->json([
                'success' => true,
                'check' => 'Y',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'check' => 'N',
            ]);
        }
    }

    public function fetchPlantServiceRepresentative(Request $request, $id)
    {
        // Check if the email exists in the users table

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

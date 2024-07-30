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

    public function edit()
    {
    }

    public function show()
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    public function saveServiceRepresentative(Request $request)
    {
        // Validate the request
        $validator = $request->validate([
            'plant_id' => 'required|integer',
        $request->validate([
            'service_rep_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'alt_phone_number' => 'nullable|string|max:15',
            'fax_number' => 'nullable|string|max:15',
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
    public function show(string $id)
    {
        $serviceRepresentative = ServiceRepresentative::findOrFail($id);
        $plantServiceRep = PlantServiceRep::updateOrCreate(
            ['plant_id' => $validator['plant_id'],
                'service_rep_id' => $serviceRep->id,
            ],
        );

        return response()->json(['success' => true, 'serviceRep' => $serviceRep, 'plantServiceRep' => $plantServiceRep]);
        return view('admin.service_representative.show', compact('serviceRepresentative'));
    }
    function updateServiceRepresentative(Request $request)

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $serviceRep = ServiceRepresentative::where('id', $request->input('service_rep_id'))->firstOrFail();
        $serviceRepresentative = ServiceRepresentative::findOrFail($id);

        $validator = $request->validate([
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
            'zip' => 'required|string|max:10',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'alt_phone_number' => 'nullable|string|max:15',
            'fax_number' => 'nullable|string|max:15',
            'contact_title' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20',
            'alt_phone_number' => 'nullable|string|max:20',
            'fax_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $serviceRepresentative = ServiceRepresentative::findOrFail($id);
        $serviceRepresentative->update($request->all());
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

        return redirect()->route('service-reps.index')
            ->with('success', 'Service Representative updated successfully.');
        return response()->json(['success' => true, 'serviceRep' => $serviceRep]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
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
        $serviceRepresentative = ServiceRepresentative::findOrFail($id);
        $serviceRepresentative->delete();

        return redirect()->route('service-reps.index')
            ->with('success', 'Service Representative deleted successfully.');
    public function fetchServiceRepresentative(Request $request, $id)
    {
        $serviceRep = ServiceRepresentative::where('id', $id)->firstOrFail();
        return response()->json(['success' => true, 'serviceRep' => $serviceRep]);
    }

    public function checkEmail($email)
    public function fetchPlantServiceRepresentative(Request $request, $id)
    {
        // Check if the email exists in the users table
        $exists = User::where('email', $email)->exists();
        $serviceRepsAll = ServiceRepresentative::all()->toArray();
        $plantServiceReps = PlantServiceRep::where('plant_id', $id)->get();
        $serviceReps = [];

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
        foreach ($plantServiceReps as $plantServiceRep) {
            $serviceReps[] = ServiceRepresentative::where('id', $plantServiceRep->service_rep_id)->first();
        }

        $serviceRepsAll =array_values($serviceRepsAll);

        return response()->json(['success' => true, 'serviceReps' => $serviceReps, 'serviceRepsAll' => $serviceRepsAll]);
    }
}

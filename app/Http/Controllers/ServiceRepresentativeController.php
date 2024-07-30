<?php

namespace App\Http\Controllers;

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

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceRepresentative = ServiceRepresentative::findOrFail($id);

        return view('admin.service_representative.show', compact('serviceRepresentative'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $serviceRepresentative = ServiceRepresentative::findOrFail($id);

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceRepresentative = ServiceRepresentative::findOrFail($id);
        $serviceRepresentative->delete();

        return redirect()->route('service-reps.index')
            ->with('success', 'Service Representative deleted successfully.');
    }

    public function checkEmail($email)
    {
        // Check if the email exists in the users table
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
}

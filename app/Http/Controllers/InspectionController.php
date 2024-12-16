<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inspections = Inspection::all();

        return view('admin.inspections.index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inspections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'inspection_type' => 'nullable|string|in:Routine,Emergency,Post-Maintenance',
        ]);

        // Create the inspection
        Inspection::create($validated);

        // Redirect back with success message
        return redirect()->route('inspections.index')->with('success', 'Inspection created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inspection $inspection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inspection $inspection)
    {
        return view('admin.inspections.edit', compact('inspection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inspection $inspection)
    {
        // Validate incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'inspection_type' => 'nullable|string|in:Routine,Emergency,Post-Maintenance',
        ]);

        // Update the inspection
        $inspection->update($validated);

        // Redirect back with success message
        return redirect()->route('inspections.index')->with('success', 'Inspection updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspection $inspection)
    {
        // Delete the inspection
        $inspection->delete();

        // Redirect back with success message
        return redirect()->route('inspections.index')->with('success', 'Inspection deleted successfully.');
    }
}

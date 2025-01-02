<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plant_id' => 'required',
            'area_name' => 'required',
            'line_frequency' => 'required',
        ]);

        $area = Area::updateOrCreate([
            'plant_id' => $validated['plant_id'],
            'name' => $validated['area_name'],
            'line_frequency' => $validated['line_frequency'],
        ]);

        return response()->json(['success' => true, 'area' => $area], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        Log::info('data', $request->all());

        $validated = $request->validate([
            'area_id' => 'required',
            'area_name' => 'required',
            'line_frequency' => 'required',
        ]);

        $area = Area::find($validated['area_id']);
        $area->name = $validated['area_name'];
        $area->line_frequency = $validated['line_frequency'];
        $area->save();

        return response()->json(['success' => true, 'area' => $area], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }

    public function fetch(Request $request, $id)
    {
        $data = Area::where('id', $id)
            ->with(['plant'])
            ->first();

        return response()->json([
            'success' => true,
            'area' => $data
        ], 200);

    }

    public function fetchByPlant($plantId)
    {
        $areas = Area::where('plant_id', $plantId)->get();
        return response()->json(['areas' => $areas]);
    }
}

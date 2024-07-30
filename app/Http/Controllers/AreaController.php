<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Site;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }

    public function fetch(Request $request)
    {
        if($request->input('id'))
        {
            $data = Area::where('id', $request->input('id'))
                ->with(['components'])
                ->first();

            if($data) return response()->json($data, 200);
            else return response()->json(['message' => 'Site is not registered in the system.'], 404);
        }
        else
        {
            $data = Area::with(['components'])
                ->get();

            if($data) return response()->json($data, 200);
            else return response()->json(['message' => 'No sites registered in the system.'], 404);
        }
    }
}

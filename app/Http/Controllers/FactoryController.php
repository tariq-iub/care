<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Illuminate\Http\Request;

class FactoryController extends Controller
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
    public function show(Factory $factory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factory $factory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factory $factory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factory $factory)
    {
        //
    }

    public function fetch(Request $request)
    {
        if($request->input('id'))
        {
            $data = Factory::where('id', $request->input('id'))
                ->with(['sites'])
                ->first();

            if($data) return response()->json($data, 200);
            else return response()->json(['message' => 'Factory is not registered in the system.'], 404);
        }
        else
        {
            $data = Factory::with(['sites'])
                ->get();

            if($data) return response()->json($data, 200);
            else return response()->json(['message' => 'No factories registered in the system.'], 404);
        }
    }
}

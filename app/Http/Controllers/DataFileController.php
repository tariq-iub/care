<?php

namespace App\Http\Controllers;

use App\Models\DataFile;
use Illuminate\Http\Request;

class DataFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "all uploaded files....";
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
     * Remove the specified resource from storage.
     */
    public function destroy(DataFile $dataFile)
    {
        //
    }

    public function download(DataFile $dataFile)
    {
        //
    }
}

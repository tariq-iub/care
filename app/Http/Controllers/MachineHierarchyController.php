<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class MachineHierarchyController extends Controller
{
    /**
     * Display the hierarchy view with all data.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch companies with their full hierarchy using Eager Loading
        $companies = Company::with([
            'plants',                      // Load plants for each company
            'plants.areas',                // Load areas for each plant
            'plants.areas.machines',       // Load machines for each area
            'plants.areas.machines.machinePoints' // Load machine points for each machine
        ])->get();

        // Return the view with the fetched data
        return view('admin.machine_hierarchy.index', compact('companies'));
    }
}

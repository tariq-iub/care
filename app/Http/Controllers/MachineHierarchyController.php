<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Machine;
use Illuminate\Http\Request;

class MachineHierarchyController extends Controller
{
    /**
     * Display the machines with their company, plant, and area hierarchy.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $companies = Company::all();
        // Fetch machines with their full hierarchy (company, plant, and area) using Eager Loading
        $machines = Machine::with([
            'area.plant.company',         // Load the plant, area, and company for each machine
        ])->get();

        // Return the view with the fetched data
        return view('admin.machine_hierarchy.index', compact('machines', 'companies'));
    }
}

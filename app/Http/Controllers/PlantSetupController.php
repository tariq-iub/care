<?php
// app/Http/Controllers/WizardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Note;
use App\Models\ServiceRep;
use Validator;

class PlantSetupController extends Controller
{
    public function index()
    {
        return view('admin.plants.index');
    }
    public function saveCompanyInfo(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'alt_phone_number' => 'nullable|string|max:15',
            'fax_number' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Save the company information
        $company = Company::updateOrCreate(
            ['id' => $request->input('company_id')],
            $request->only([
                'company_name', 'address', 'city', 'state', 'zip', 'country',
                'contact_name', 'contact_title', 'phone_number', 'alt_phone_number',
                'fax_number', 'email'
            ])
        );

        return response()->json(['success' => true, 'company' => $company]);
    }

    public function saveNotesPictures(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'notes' => 'nullable|string',
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Save notes
        $notes = $request->input('notes');

        // Handle picture uploads
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                // Save picture path or filename to the database if needed
            }
        }

        return response()->json(['success' => true, 'notes' => $notes]);
    }

    public function saveServiceRepInfo(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'service_rep_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'alt_phone_number' => 'nullable|string|max:15',
            'fax_number' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Save service rep information
        $serviceRep = ServiceRep::updateOrCreate(
            ['id' => $request->input('service_rep_id')],
            $request->only([
                'service_rep_name', 'address', 'city', 'state', 'zip', 'country',
                'contact_name', 'contact_title', 'phone_number', 'alt_phone_number',
                'fax_number', 'email'
            ])
        );

        return response()->json(['success' => true, 'serviceRep' => $serviceRep]);
    }
}

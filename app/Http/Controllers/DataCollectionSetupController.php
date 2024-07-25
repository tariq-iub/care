<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataCollectionSetupController extends Controller
{
    public function index()
    {
        // Define static arrays for dropdowns
        $cutoffFrequencies = ['10 Hz', '20 Hz', '50 Hz', '100 Hz'];
        $resolutions = ['High', 'Medium', 'Low'];
        $transducerTypes = ['Accelerometer', 'Velocity Probe', 'Proximity Probe', 'Volts Dynamic'];
        $sensitivityUnits = ['mV/g', 'V/in', 'mV/Pa', 'V/m/s²', 'mA/g'];
        $averageTypes = ['Spectral', 'Time Synchronous'];
        $averageOverlapPercentages = ['0%', '12.5%', '25%', '37.5%', '50%', '62.5%', '75%'];
        $windowTypes = ['Hanning', 'Hamming', 'Flat Top', 'Rectangular'];
        $highPassFilters = ['500 Hz', '1000 Hz', '2000 Hz', '3000 Hz', '4000 Hz', '5000 Hz'];
        $bandPassFilters = [
            '1250-2500 Hz', '1250-5000 Hz', '1250-10000 Hz',
            '2500-5000 Hz', '3400-4400 Hz', '5000-10000 Hz'
        ];

        // Pass arrays to the view
        return view('admin.data_collection_setup.index', compact(
            'cutoffFrequencies',
            'resolutions',
            'transducerTypes',
            'sensitivityUnits',
            'averageTypes',
            'averageOverlapPercentages',
            'windowTypes',
            'highPassFilters',
            'bandPassFilters'
        ));
    }

    public function complete(Request $request)
    {
        $validatedData = $request->validate([
            'cutoff_frequency' => 'required',
            'resolution' => 'required',
            'transducer_type' => 'required',
            'sensitivity' => 'required',
            'unit' => 'required',
            'average_type' => 'required',
            'number_of_averages' => 'required',
            'average_overlap_percentage' => 'required',
            'window_type' => 'required',
            'impact_demodulation' => 'boolean',
            'high_pass_filter' => 'required_if:impact_demodulation,false',
            'band_pass_filter' => 'required_if:impact_demodulation,true',
        ]);

        // Process the validated data here (save to database, etc.)

        return redirect()->route('setup.complete')->with('success', 'Setup complete!');
    }

    // Save General Setup
    public function postGeneral(Request $request)
    {
        $validated = $request->validate([
            'cutoff_frequency' => 'required|numeric',
            'resolution' => 'required|string|max:255',
            'transducer_type' => 'required|string',
            'icp_current_source' => 'nullable|boolean',
            'sensitivity' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        // Save data to the database
        $setup = DataCollectionSetup::updateOrCreate(
            ['user_id' => auth()->id()], // Assuming user-specific setups
            $validated
        );

        return response()->json(['success' => true, 'setup' => $setup]);
    }

    // Save Measurement Setup
    public function postMeasurement(Request $request)
    {
        $validated = $request->validate([
            'average_type' => 'required|string',
            'number_of_averages' => 'required|integer',
            'average_overlap_percentage' => 'required|string',
            'window_type' => 'required|string',
        ]);

        // Update the existing setup or create a new one
        $setup = DataCollectionSetup::where('user_id', auth()->id())->first();
        if ($setup) {
            $setup->update($validated);
        } else {
            $setup = DataCollectionSetup::create(array_merge(
                ['user_id' => auth()->id()],
                $validated
            ));
        }

        return response()->json(['success' => true, 'setup' => $setup]);
    }

    // Save Demodulation Setup
    public function postDemodulation(Request $request)
    {
        $validated = $request->validate([
            'impact_demodulation' => 'nullable|boolean',
            'high_pass_filter' => 'required_without:impact_demodulation|string',
            'band_pass_filter' => 'required_with:impact_demodulation|string',
        ]);

        // Update the existing setup or create a new one
        $setup = DataCollectionSetup::where('user_id', auth()->id())->first();
        if ($setup) {
            $setup->update($validated);
        } else {
            $setup = DataCollectionSetup::create(array_merge(
                ['user_id' => auth()->id()],
                $validated
            ));
        }

        return response()->json(['success' => true, 'setup' => $setup]);
    }
}

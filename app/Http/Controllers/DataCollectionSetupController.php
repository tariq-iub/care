<?php

namespace App\Http\Controllers;

use App\Models\DataCollectionSetup;
use App\Models\CutOffFrequency;
use App\Models\Demodulation;
use App\Models\General;
use App\Models\Measurement;
use App\Models\Resolution;
use App\Models\Transducer;
use App\Models\Units;
use Illuminate\Http\Request;

class DataCollectionSetupController extends Controller
{
    public function index()
    {
        $dataCollectionSetups = DataCollectionSetup::all();


        return view('admin.data_collection_setup.index', compact('dataCollectionSetups'));
    }
    public function create()
    {
        // Define static arrays for dropdowns
        $cutoffFrequencies = CutOffFrequency::all()->pluck('value')->toArray();
        $resolutions = Resolution::all()->pluck('value')->toArray();
        $transducerTypes = Transducer::all()->pluck('title')->toArray();
        $sensitivityUnits = Units::all()->pluck('title')->toArray();
        $averageTypes = getAverageType();
        $averageOverlapPercentages = getAverageOverlapPercentages();
        $windowTypes = getWindowType();
        $highPassFilters = getHighPassFilters();
        $bandPassFilters = getBandPassFilters();

        // Pass arrays to the view
        return view('admin.data_collection_setup.create', compact(
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

    public function edit(DataCollectionSetup $dataCollectionSetup)
    {
        $general = General::with('dataCollectionSetup')->where('data_collection_setup_id', $dataCollectionSetup->id)->first();
        $measurement = Measurement::with('dataCollectionSetup')->where('data_collection_setup_id', $dataCollectionSetup->id)->first();
        $demodulation = Demodulation::with('dataCollectionSetup')->where('data_collection_setup_id', $dataCollectionSetup->id)->first();

        $cutoffFrequencies = CutOffFrequency::all()->pluck('value')->toArray();
        $resolutions = Resolution::all()->pluck('value')->toArray();
        $transducerTypes = Transducer::all()->pluck('title')->toArray();
        $sensitivityUnits = Units::all()->pluck('title')->toArray();
        $averageTypes = getAverageType();
        $averageOverlapPercentages = getAverageOverlapPercentages();
        $windowTypes = getWindowType();
        $highPassFilters = getHighPassFilters();
        $bandPassFilters = getBandPassFilters();

        // Pass arrays to the view
        return view('admin.data_collection_setup.edit', compact(

            'dataCollectionSetup',
            'cutoffFrequencies',
            'general',
            'measurement',
            'demodulation',
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

    public function show(DataCollectionSetup $dataCollectionSetup)
    {
        $general = General::with('dataCollectionSetup')->where('data_collection_setup_id', $dataCollectionSetup->id)->first();
        $measurement = Measurement::with('dataCollectionSetup')->where('data_collection_setup_id', $dataCollectionSetup->id)->first();
        $demodulation = Demodulation::with('dataCollectionSetup')->where('data_collection_setup_id', $dataCollectionSetup->id)->first();

        return view('admin.data_collection_setup.show', compact(

            'dataCollectionSetup',
            'general',
            'measurement',
            'demodulation',
        ));
    }


    public function complete(Request $request)
    {
        $validatedData = $request->validate([
            'setup_name' => 'required',
            'cut_off_frequency' => 'required',
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

        print_r ($validated);
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

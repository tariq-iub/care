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
        $setups = DataCollectionSetup::all();
        return view('admin.data_collection_setup.index', compact('setups'));
    }

    public function create()
    {
        // Define static arrays for dropdowns
        $cutoffFrequencies = CutOffFrequency::all()->pluck('value')->toArray();
        $resolutions = Resolution::all()->pluck('value')->toArray();
        $transducerTypes = Transducer::all()->pluck('title')->toArray();
        $sensitivityUnits = Units::all()->pluck('unit')->toArray();
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
        $sensitivityUnits = Units::all()->pluck('unit')->toArray();
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

    public function getSetupDetails($id)
    {
        // Fetch the record from the database
        $setup = DataCollectionSetup::find($id);

        $general = General::with('dataCollectionSetup')->where('data_collection_setup_id', $setup->id)->first();
        $measurement = Measurement::with('dataCollectionSetup')->where('data_collection_setup_id', $setup->id)->first();
        $demodulation = Demodulation::with('dataCollectionSetup')->where('data_collection_setup_id', $setup->id)->first();


        // Check if the record exists
        if ($setup) {
            // Return the setup data as JSON
            return response()->json([
                'success' => true,
                'data' => [
                    'setup' => $setup,
                    'general' =>$general,
                    'measurement' =>$measurement,
                    'demodulation' =>$demodulation,
                ]
            ]);
        }

        // Return an error response if the setup is not found
        return response()->json([
            'success' => false,
            'message' => 'Setup not found.'
        ]);
    }

    public function store(Request $request)
    {

    }

    public function saveGeneralData(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'setup_name' => 'required|string|max:255',
            'cutoff_frequency' => 'required|numeric',
            'resolution' => 'required|string|max:255',
            'transducer_type' => 'required|string',
            'sensitivity' => 'required|numeric',
            'sensitivity_unit' => 'required|string',
        ]);

        // Create or update the data collection setup
        $setup = DataCollectionSetup::updateOrCreate(
            ['setup_name' => $validated['setup_name']]
        );

        // Handle General Form Data
        General::updateOrCreate(
            [
                'cut_off_frequency' => $validated['cutoff_frequency'],
                'resolution' => $validated['resolution'],
                'transducer_type' => $validated['transducer_type'],
                'sensitivity' => $validated['sensitivity'],
                'unit' => $validated['sensitivity_unit'],
                'data_collection_setup_id' => $setup->id,
            ]
        );

        return response()->json(['success' => true, 'setup' => $setup]);
    }

    public function saveMeasurementData(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'data_collection_setup_id' => 'required|numeric',
            'average_type' => 'required|string',
            'number_of_averages' => 'required|integer',
            'average_overlap_percentage' => 'required|string',
            'window_type' => 'required|string',
        ]);

        $setup = DataCollectionSetup::where('id', $validated['data_collection_setup_id'])->first();

        // Handle Measurement Form Data
        Measurement::updateOrCreate(
            [
                'average_type' => $validated['average_type'],
                'number_of_averages' => $validated['number_of_averages'],
                'average_overlap_percentage' => $validated['average_overlap_percentage'],
                'window_type' => $validated['window_type'],
                'data_collection_setup_id' => $validated['data_collection_setup_id'],
            ]
        );

        return response()->json(['success' => true, 'setup' => $setup]);
    }

    public function saveDemodulationData(Request $request)
    {
        // Convert impact_demodulation to boolean if it is a string
        $impactDemodulation = filter_var($request->input('impact_demodulation'), FILTER_VALIDATE_BOOLEAN);

        // Set impact_demodulation back to request after conversion
        $request->merge(['impact_demodulation' => $impactDemodulation]);

        // Validate the incoming request
        $validated = $request->validate([
            'data_collection_setup_id' => 'required|numeric',
            'impact_demodulation' => 'nullable|boolean',
            'high_pass_filter' => 'required_without:impact_demodulation|string',
            'band_pass_filter' => 'required_with:impact_demodulation|string',
        ]);

        // Retrieve the setup based on the ID
        $setup = DataCollectionSetup::find($validated['data_collection_setup_id']);
        if (!$setup) {
            return response()->json(['error' => 'Setup not found.'], 404);
        }

        // Determine the filter type and value
        if ($validated['impact_demodulation']) {
            $filterType = 'band_pass_filter';
            $filterValue = $validated['band_pass_filter'];
        } else {
            $filterType = 'high_pass_filter';
            $filterValue = $validated['high_pass_filter'];
        }

        // Handle Demodulation Form Data
        Demodulation::updateOrCreate(
            [
                'filter_type' => $filterType,
                'filter_value' => $filterValue,
                'data_collection_setup_id' => $validated['data_collection_setup_id']
            ]
        );

        return response()->json(['success' => true, 'setup' => $setup]);
    }

    public function updateGeneralData(Request $request, $setupId)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'cutoff_frequency' => 'required|numeric',
            'resolution' => 'required|string|max:255',
            'transducer_type' => 'required|string',
            'sensitivity' => 'required|numeric',
            'sensitivity_unit' => 'required|string',
        ]);

        // Update General Form Data
        $general = General::where('data_collection_setup_id', $setupId)->first();
        if ($general) {
            $general->update([
                'cut_off_frequency' => $validated['cutoff_frequency'],
                'resolution' => $validated['resolution'],
                'transducer_type' => $validated['transducer_type'],
                'sensitivity' => $validated['sensitivity'],
                'unit' => $validated['sensitivity_unit'],
            ]);
        } else {
            return response()->json(['error' => 'General data not found.'], 404);
        }

        return response()->json(['success' => true, 'setup' => ""]);
    }

    public function updateMeasurementData(Request $request, $setupId)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'average_type' => 'required|string',
            'number_of_averages' => 'required|integer',
            'average_overlap_percentage' => 'required|string',
            'window_type' => 'required|string',
        ]);

        // Update General Form Data
        $measurement = Measurement::where('data_collection_setup_id', $setupId)->first();
        if ($measurement) {
            $measurement->update([
                'average_type' => $validated['average_type'],
                'number_of_averages' => $validated['number_of_averages'],
                'average_overlap_percentage' => $validated['average_overlap_percentage'],
                'window_type' => $validated['window_type'],
            ]);
        } else {
            return response()->json(['error' => 'Measurement data not found.'], 404);
        }

        return response()->json(['success' => true, 'setup' => ""]);
    }

    public function updateDemodulationData(Request $request, $setupId)
    {
        // Convert impact_demodulation to boolean if it is a string
        $impactDemodulation = filter_var($request->input('impact_demodulation'), FILTER_VALIDATE_BOOLEAN);

        // Set impact_demodulation back to request after conversion
        $request->merge(['impact_demodulation' => $impactDemodulation]);

        // Validate the incoming request
        $validated = $request->validate([
            'impact_demodulation' => 'nullable|boolean',
            'high_pass_filter' => 'required_without:impact_demodulation|string',
            'band_pass_filter' => 'required_with:impact_demodulation|string',
        ]);

        // Determine the filter type and value
        $filterType = $validated['impact_demodulation'] ? 'band_pass_filter' : 'high_pass_filter';
        $filterValue = $validated['impact_demodulation'] ? $validated['band_pass_filter'] : $validated['high_pass_filter'];

        // Update Demodulation Form Data
        $demodulation = Demodulation::where('data_collection_setup_id', $setupId)->first();
        if ($demodulation) {
            $demodulation->update([
                'filter_type' => $filterType,
                'filter_value' => $filterValue,
            ]);
        } else {
            return response()->json(['error' => 'Demodulation data not found.'], 404);
        }

        return response()->json(['success' => true, 'setup' => ""]);
    }
}

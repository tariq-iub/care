<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\FaultCodes;
use App\Models\ForcingFrequencies;
use App\Models\MidComponents;
use App\Models\MidGenerals;
use App\Models\MidSetup;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\DesignLayoutService;

class NewMidController extends Controller
{
    public function index()
    {
        $midGeneral = MidGenerals::with('midSetup')->get();
        $midSetups = MidSetup::all();

        return view('admin.new_mid.index', compact('midGeneral', 'midSetups'));
    }


    public function create(Request $request)
    {
        if (session()->has('midSetupId')) {
            $midSetupId = session()->get('midSetupId');
            session()->forget('midSetupId');
        } else {
            $data = request()->all();
            $midSetupId = $request->query('mid_setup_id');
//            $midSetupId = $data['mid_setup_id'] ?? null;
        }
        $midSetup = MidSetup::find($midSetupId);

        $faultCodes = FaultCodes::all();

        $forcing_frequencies = [
            ['code' => '1X', 'multiple'=>'1', 'name' => '1X Shaft', 'on_secondary' => 'No', 'elements' => '1', 'final_ratio' => '1'],
            ['code' => '2X', 'multiple'=>'1', 'name' => '2X Shaft', 'on_secondary' => 'No', 'elements' => '2', 'final_ratio' => '1'],
            ['code' => '3X', 'multiple'=>'1', 'name' => '3X Shaft', 'on_secondary' => 'No', 'elements' => '3', 'final_ratio' => '1'],
            ['code' => '4X', 'multiple'=>'1', 'name' => '4X Shaft', 'on_secondary' => 'No', 'elements' => '4', 'final_ratio' => '1'],
            ['code' => '5X', 'multiple'=>'1', 'name' => '5X Shaft', 'on_secondary' => 'No', 'elements' => '5', 'final_ratio' => '1'],
            ['code' => '6X', 'multiple'=>'1', 'name' => '6X Shaft', 'on_secondary' => 'No', 'elements' => '6', 'final_ratio' => '1'],
            ['code' => '7X', 'multiple'=>'1', 'name' => '7X Shaft', 'on_secondary' => 'No', 'elements' => '7', 'final_ratio' => '1'],
            ['code' => '8X', 'multiple'=>'1', 'name' => '8X Shaft', 'on_secondary' => 'No', 'elements' => '8', 'final_ratio' => '1'],
            ['code' => '9X', 'multiple'=>'1', 'name' => '9X Shaft', 'on_secondary' => 'No', 'elements' => '9', 'final_ratio' => '1'],
            ['code' => '10X', 'multiple'=>'1', 'name' => '10X Shaft', 'on_secondary' => 'No', 'elements' => '10', 'final_ratio' => '1']
        ];

        $layout = new DesignLayoutService();
        $components = $layout->getMachineDesignLayout($midSetupId);

        Log::info($components);

        return view('admin.new_mid.create', compact( 'midSetup', 'forcing_frequencies', 'faultCodes', 'components'));
    }

    public function edit($id){
        $midSetup = MidSetup::find($id);
        $midGeneral = MidGenerals::where('mid_setup_id', $id)->first();
        $midComponents = MidComponents::where('mid_setup_id', $id)->get();

        foreach ($midComponents as $component) {
            $component->bearings_monitored_array = explode(',', $component->bearings_monitored);;
        }

        $forcing_frequencies = ForcingFrequencies::where('mid_setup_id', $id)->get();
        $faultCodes = FaultCodes::all();

        $layout = new DesignLayoutService();
        $components = $layout->getMachineDesignLayout($id);

        return view('admin.new_mid.edit', compact('midSetup', 'midGeneral', 'midComponents', 'forcing_frequencies', 'faultCodes', 'components'));
    }

    public function show($id)
    {
        $midSetup = MidSetup::find($id);
        $midGeneral = MidGenerals::where('mid_setup_id', $id)->first();
        $midComponents = MidComponents::where('mid_setup_id', $id)->get();

        foreach ($midComponents as $component) {
            $component->bearings_monitored_array = explode(',', $component->bearings_monitored);;
        }

        $forcing_frequencies = ForcingFrequencies::where('mid_setup_id', $id)->get();
        $faultCodes = FaultCodes::all();

        $layout = new DesignLayoutService();
        $components = $layout->getMachineDesignLayout($id);

        return view('admin.new_mid.show', compact('midSetup', 'midGeneral', 'midComponents', 'forcing_frequencies', 'faultCodes', 'components'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $generalData = $data['general'];
        $components = $data['components'];
        $forcingFrequencies = $data['forcingFrequencies'];

        if (MidSetup::where('id', $generalData['midNumber'])->exists()) {
            $midSetup = MidSetup::where('id', $generalData['midNumber'])->first();
            $midSetup->update(['title' => $generalData['name']]);
        } else {
            $midSetup = MidSetup::create([
                'id' => $generalData['midNumber'],
                'title' => $generalData['name'],
            ]);
        }

        MidGenerals::where('mid_setup_id', $generalData['midNumber'])->delete();
        ForcingFrequencies::where('mid_setup_id', $generalData['midNumber'])->delete();
        MidComponents::where('mid_setup_id', $generalData['midNumber'])->delete();

        $midGeneral = MidGenerals::create([
            'mid_setup_id' => $generalData['midNumber'],
            'nominal_speed' => $generalData['nominalSpeed'],
            'speed_unit' => $generalData['nominalSpeedType'],
            'secondary_speed_ratio' => $generalData['secondarySpeedRatio'],
            'mid_rating' => $generalData['midRating'],
            'machine_orientation' => $generalData['machineOrientation']
        ]);

        foreach ($forcingFrequencies as $forcingFrequency) {
            $forcingFrequency = ForcingFrequencies::create([
                'mid_setup_id' => $generalData['midNumber'],
                'code' => $forcingFrequency['code'],
                'multiple' => $forcingFrequency['multiple'],
                'name' => $forcingFrequency['name'],
                'on_secondary' => $forcingFrequency['on_secondary'] == 'Yes' ? 1 : 0,
                'elements' => $forcingFrequency['elements'],
                'final_ratio' => $forcingFrequency['final_ratio']
            ]);
        }

        foreach ($components as $component) {
            $bearings_monitored = implode(',', $component['bearingMonitored']);

            $midComponent = MidComponents::create([
                'mid_setup_id' => $generalData['midNumber'],
                'component_code' => $component['componentCode'],
                'description' => $component['description'],
                'pickup_code' => $component['pickupCode'],
                'bearings_monitored' => $bearings_monitored
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        Log::info($id);
        Log::info($data);

        $generalData = $data['general'];
        $components = $data['components'];
        $forcingFrequencies = $data['forcingFrequencies'];

        $midSetup = MidSetup::find($generalData['midNumber']);
        $midSetup->update(['title' => $generalData['name']]);

        $midGeneral = MidGenerals::where('id', $generalData['midGeneralId'])->first();

        if ($midGeneral) {
            $midGeneral->update([
                'nominal_speed' => $generalData['nominalSpeed'],
                'speed_unit' => $generalData['nominalSpeedType'],
                'secondary_speed_ratio' => $generalData['secondarySpeedRatio'],
                'mid_rating' => $generalData['midRating'],
                'machine_orientation' => $generalData['machineOrientation']
            ]);
        } else {
            $midGeneral = MidGenerals::create([
                'mid_setup_id' => $generalData['midNumber'],
                'nominal_speed' => $generalData['nominalSpeed'],
                'speed_unit' => $generalData['nominalSpeedType'],
                'secondary_speed_ratio' => $generalData['secondarySpeedRatio'],
                'mid_rating' => $generalData['midRating'],
                'machine_orientation' => $generalData['machineOrientation']
            ]);
        }


        foreach ($forcingFrequencies as $forcingFrequency) {
            if ($forcingFrequency['id']) {
                $forcing_frequency = ForcingFrequencies::find($forcingFrequency['id']);
                $forcing_frequency->update([
                    'code' => $forcingFrequency['code'],
                    'multiple' => $forcingFrequency['multiple'],
                    'name' => $forcingFrequency['name'],
                    'on_secondary' => $forcingFrequency['on_secondary'] == 'Yes' ? 1 : 0,
                    'elements' => $forcingFrequency['elements'],
                    'final_ratio' => $forcingFrequency['final_ratio']
                ]);
            } else {
                $forcing_frequency = ForcingFrequencies::create([
                    'mid_setup_id' => $id,
                    'code' => $forcingFrequency['code'],
                    'multiple' => $forcingFrequency['multiple'],
                    'name' => $forcingFrequency['name'],
                    'on_secondary' => $forcingFrequency['on_secondary'] == 'Yes' ? 1 : 0,
                    'elements' => $forcingFrequency['elements'],
                    'final_ratio' => $forcingFrequency['final_ratio']
                ]);
            }
        }

        foreach ($components as $component) {
            if ($component['id']) {
                $bearings_monitored = implode(',', $component['bearingMonitored']);
                $midComponent = MidComponents::find($component['id']);
                $midComponent->update([
                    'component_code' => $component['componentCode'],
                    'description' => $component['description'],
                    'pickup_code' => $component['pickupCode'],
                    'bearings_monitored' => $bearings_monitored
                ]);
            } else {
                $bearings_monitored = implode(',', $component['bearingMonitored']);
                $midComponent = MidComponents::create([
                    'mid_setup_id' => $id,
                    'component_code' => $component['componentCode'],
                    'description' => $component['description'],
                    'pickup_code' => $component['pickupCode'],
                    'bearings_monitored' => $bearings_monitored
                ]);
            }
        }

        return response()->json(['success' => true]);
    }
}

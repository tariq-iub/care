<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\MachineInfo;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surveys = Survey::all();

        return view('admin.surveys.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inspections = Inspection::all();
        $engineers = User::all();

        return view('admin.surveys.create', compact('inspections', 'engineers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'survey_name' => 'required|string|max:255',
            'survey_type' => 'nullable|string|max:255',
            'scheduled_at' => 'nullable|date',
            'taken_up' => 'required|boolean',
            'status' => 'required|string|in:Pending,In Progress,Completed',
            'inspection_id' => 'nullable|exists:inspections,id',
            'engineer_id' => 'nullable|exists:users,id',
        ]);

        Survey::create([
            'survey_name' => $request->survey_name,
            'survey_type' => $request->survey_type,
            'scheduled_at' => $request->scheduled_at,
            'taken_up' => $request->taken_up,
            'status' => $request->status,
            'inspection_id' => $request->inspection_id,
            'engineer_id' => $request->engineer_id,
        ]);

        return redirect()->route('surveys.index')->with('success', 'Survey created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        return view('admin.surveys.show', compact('survey'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
        $inspections = Inspection::all();
        $engineers = User::all();

        return view('admin.surveys.edit', compact('survey', 'inspections', 'engineers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Survey $survey)
    {
        $request->validate([
            'survey_name' => 'required|string|max:255',
            'survey_type' => 'nullable|string|max:255',
            'scheduled_at' => 'nullable|date',
            'taken_up' => 'required|boolean',
            'status' => 'required|string|in:Pending,In Progress,Completed',
            'inspection_id' => 'nullable|exists:inspections,id',
            'engineer_id' => 'nullable|exists:users,id',
        ]);

        $survey->update([
            'survey_name' => $request->survey_name,
            'survey_type' => $request->survey_type,
            'scheduled_at' => $request->scheduled_at,
            'taken_up' => $request->taken_up,
            'status' => $request->status,
            'inspection_id' => $request->inspection_id,
            'engineer_id' => $request->engineer_id,
        ]);

        return redirect()->route('surveys.index')->with('success', 'Survey updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();

        return redirect()->route('surveys.index')->with('success', 'Survey deleted successfully.');
    }

    public function attachMachines(Request $request)
    {
        $surveyId = $request->input('survey_id');
        $machineIds = $request->input('machine_ids', []);

        // Attach machines to the survey
        Survey::findOrFail($surveyId)->machines()->syncWithoutDetaching($machineIds);

        return redirect()->back()->with('success', 'Machines attached successfully!');
    }

    public function detachMachines(Request $request)
    {
        $surveyId = $request->input('survey_id');
        $machineIds = $request->input('machine_ids', []);

        // Detach machines from the survey
        Survey::findOrFail($surveyId)->machines()->detach($machineIds);

        return redirect()->back()->with('success', 'Machines detached successfully!');
    }

    // Get available machines for attachment
    public function getAttachMachines($surveyId)
    {
        $survey = Survey::findOrFail($surveyId);
        $machine_ids = $survey->machines()->pluck('machine_infos.id')->toArray();

        // Get machines that are not already attached to the survey
        $machines = MachineInfo::whereNotIn('id', $machine_ids)->get();

        return response()->json([
            'list' => view('admin.surveys.partials.machines_assignment_body', ['machines' => $machines])->render(),
            'message' => 'success',
        ]);
    }

    // Get attached machines for detachment
    public function getDetachMachines($surveyId)
    {
        $survey = Survey::findOrFail($surveyId);

        // Get machines that are already attached to the survey
        $machines = $survey->machines;

        return response()->json([
            'list' => view('admin.surveys.partials.machines_assignment_body', ['machines' => $machines])->render(),
            'message' => 'success',
        ]);
    }
}

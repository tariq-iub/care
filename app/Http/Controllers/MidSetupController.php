<?php

namespace App\Http\Controllers;

use App\Models\MidQuestions;
use App\Models\MidSetup;
use App\Models\MidSetupAnswers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MidSetupController extends Controller
{
    public function index()
    {
        $midSetups = MidSetup::with('bodies')->get();
        return view('admin.mid_setup.index', compact('midSetups'));
    }

    public function create()
    {
        $questions = MidQuestions::with('answers')->get();
        $questions = $questions->sortBy('sort_order');

        foreach ($questions as $question) {
            $question_answers = DB::table('question_answers')
                ->where('mid_question_id', $question->id)
                ->get();

            foreach ($question_answers as $answer) {
                $question->group = $answer->group;
            }
            $question->question_answers = $question_answers;

        }

        return view('admin.mid_setup.create', compact('questions'));
    }

    public function edit($id)
    {
        $midSetup = MidSetup::with('bodies')->findOrFail($id);
        $midSetupAnswers = MidSetupAnswers::where('mid_setup_id', $midSetup->id)->get();
        $questions = MidQuestions::with('answers')->get();

        $questions = $questions->sortBy('sort_order');

        foreach ($questions as $question) {
            foreach ($midSetupAnswers as $answer) {
                if ($question->id == $answer->mid_question_id) {
                    $question->selected_answer = $answer->mid_answer_id;
                }
            }
        }

        return view('admin.mid_setup.edit', compact('midSetup', 'midSetupAnswers', 'questions'));
    }

    public function store(Request $request)
    {
        $inputData = $request->all();

        $midSetup = MidSetup::create([
            'title' => $inputData['midName'],
        ]);

        foreach ($inputData as $key => $value) {
            if (strpos($key, 'flexRadioDefault')===0) {
                $question_id = str_replace('flexRadioDefault', '', $key);
                MidSetupAnswers::create([
                    'mid_setup_id' => $midSetup->id,
                    'mid_question_id' => $question_id,
                    'mid_answer_id' => $value,
                ]);
            }
        }
        return response()->json(['message' => 'Mid setup created successfully']);
    }

    public function update(Request $request, $id)
    {
        $inputData = $request->all();

        $midSetup = MidSetup::findOrFail($id);
        $midSetup->update([
            'title' => $inputData['midName'],
        ]);

        MidSetupAnswers::where('mid_setup_id', $midSetup->id)->delete();

        foreach ($inputData as $key => $value) {
            if (strpos($key, 'flexRadioDefault')===0) {
                $question_id = str_replace('flexRadioDefault', '', $key);
                MidSetupAnswers::create([
                    'mid_setup_id' => $midSetup->id,
                    'mid_question_id' => $question_id,
                    'mid_answer_id' => $value,
                ]);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Mid setup updated successfully']);
    }

    public function destroy($id)
    {
        $midSetup = MidSetup::findOrFail($id);

        $midSetupAnswers = MidSetupAnswers::where('mid_setup_id', $midSetup->id)->get();
        $midSetupAnswers->each->delete();

        $midSetup->delete();

        return redirect()->route('mid_setups.index');
    }
}

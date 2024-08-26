<?php

namespace App\Http\Controllers;

use App\Models\MidAnswers;
use App\Models\MidQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = MidQuestions::with('answers')->get();

        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $question = MidQuestions::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'sort_order' => $request->input('sort_order', 0), // Default to 0 if not provided
        ]);

        if ($request->has('answers')) {
            $answerIds = [];
            foreach ($request->input('answers') as $answerBody) {
                $answer = MidAnswers::create([
                    'body' => $answerBody,
                ]);
                $answerIds[] = $answer->id;
            }

            $question->answers()->attach($answerIds);
        }

        return redirect()->route('question.index')->with('success', 'Question and answers saved successfully.');
    }


    public function show($id)
    {
        $question = MidQuestions::with('mid_answers')->findOrFail($id);

        return view('admin.questions.show', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = MidQuestions::findOrFail($id);
        $question->update($request->only('title', 'body'));

        if ($request->has('answers')) {
            $answerIds = [];
            // Update existing answers

            foreach ($request->input('answer_ids') as $key => $answerId) {
                $answer = MidAnswers::findOrFail($answerId);
                $answer->update([
                    'body' => $request->input('answers')[$key],
                ]);
                $answerIds[] = $answer->id;
            }

            // Attach answers to the question using the pivot table
            $question->answers()->sync($answerIds);
        }

        return redirect()->back();
    }


    public function destroy($id)
    {
        $results = DB::table('question_answers')->where('mid_question_id', $id)->get();

        foreach ($results as $result) {
            MidAnswers::where('id', $result->mid_answer_id)->delete();
        }

        $question = MidQuestions::findOrFail($id);
        $question->answers()->detach();
        $question->delete();

        return redirect()->back();
    }

    public function fetchQuestion($id)
    {
        $question = MidQuestions::with('answers')->findOrFail($id);

        return response()->json(['question' => $question]);
    }
}

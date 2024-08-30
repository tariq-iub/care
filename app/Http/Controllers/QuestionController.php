<?php

namespace App\Http\Controllers;

use App\Models\MidAnswers;
use App\Models\MidQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class QuestionController extends Controller
{
    public function index()
    {
        $questions = MidQuestions::with('answers')->get();
        $questions = $questions->sortBy('sort_order');

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
            'sort_order' => $request->input('sort_order', 0),
        ]);

        if ($request->has('answers')) {
            if ($request->input('group') == 'general') {
                for ($i = 0; $i < count($request->input('answers')); $i++) {
                    $answer = MidAnswers::create([
                        'body' => $request->input('answers')[$i],
                        'answer_type' => $request->input('answer_type')[$i],
                    ]);
                    $question->answers()->attach($answer->id, ['group' => $request->input('group')]);
                }
            } else {
                foreach ($request->input('answers') as $groupName => $groupAnswers) {
                    foreach ($groupAnswers as $index => $answerBody) {
                        $answer = MidAnswers::create([
                            'body' => $answerBody,
                            'answer_type' => $request->input('answer_type')[$groupName][$index] ?? null,
                        ]);

                        $question->answers()->attach($answer->id, ['group' => $groupName == 'custom' ? $request->input('group') : $groupName]);
                    }
                }
            }
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
        $question->update($request->only('title', 'body', 'sort_order'));

        DB::table('question_answers')->where('mid_question_id', $id)->delete();

        if ($request->has('answers')) {
            if ($request->input('group') == 'general') {
                for ($i = 0; $i < count($request->input('answers')); $i++) {
                    $answer = MidAnswers::create([
                        'body' => $request->input('answers')[$i],
                        'answer_type' => $request->input('answer_type')[$i],
                    ]);
                    $question->answers()->attach($answer->id, ['group' => $request->input('group')]);
                }
            } else {
                foreach ($request->input('answers') as $groupName => $groupAnswers) {
                    foreach ($groupAnswers as $index => $answerBody) {
                        $answer = MidAnswers::create([
                            'body' => $answerBody,
                            'answer_type' => $request->input('answer_type')[$groupName][$index] ?? null,
                        ]);

                        $question->answers()->attach($answer->id, ['group' => $groupName == 'custom' ? $request->input('group') : $groupName]);
                    }
                }
            }
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

        $question_answers = DB::table('question_answers')
            ->where('mid_question_id', $id)
            ->get();

        return response()->json(['question' => $question, 'question_answers' => $question_answers]);
    }
}

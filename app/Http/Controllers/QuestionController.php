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
        $questions = MidQuestions::with('answers')->get()->sortBy('sort_order');

        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        $parentQuestions = DB::table('question_answers')->get();

        $midQuestionIds = $parentQuestions->pluck('mid_question_id')->unique()->toArray();
        $midAnswerIds = $parentQuestions->pluck('mid_answer_id')->toArray();

        $midQuestions = MidQuestions::whereIn('id', $midQuestionIds)->get();
        $midAnswers = MidAnswers::whereIn('id', $midAnswerIds)->get();

        return view('admin.questions.create', compact('parentQuestions',  'midQuestions', 'midAnswers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'sort_order' => 'nullable|integer',
            'groups' => 'required|array',
            'answers' => 'required|array',
            'answer_type' => 'required|array',
            'parent_question_id' => 'nullable|integer',
            'parent_answer_id' => 'nullable|integer',
        ]);

        if ($request->input('parent_question_id') && $request->input('parent_answer_id')) {
            $questionAnswer = DB::table('question_answers')
                ->where('mid_question_id', $request->input('parent_question_id'))
                ->where('mid_answer_id', $request->input('parent_answer_id'))
                ->first();
        } elseif ($request->input('parent_answer_id') == null) {
            $questionAnswer = DB::table('question_answers')
                ->where('mid_question_id', $request->input('parent_question_id'))
                ->first();
        }

        $question = MidQuestions::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        if ($request->has('answers')) {
            foreach ($request->input('answers') as $groupName => $groupAnswers) {
                foreach ($groupAnswers as $index => $answerBody) {
                    $answer = MidAnswers::create([
                        'body' => $answerBody,
                        'answer_type' => $request->input('answer_type')[$groupName][$index] ?? null,
                    ]);

                    $question->answers()->attach($answer->id, ['group' => $groupName, 'parent_id' => $questionAnswer->id ?? null]);
                }
            }
        }

        return redirect()->route('question.index')->with('success', 'Question and answers created successfully.');
    }

    public function edit($id)
    {
        $question = MidQuestions::with('answers')->findOrFail($id);

        $question_answers = DB::table('question_answers')
            ->where('mid_question_id', $id)
            ->get();

        $parent_question_answer = DB::table('question_answers')
            ->where('id', $question_answers[0]->parent_id)
            ->first();

        foreach ($question_answers as $question_answer) {
            $groups[] = $question_answer->group;
        }

        $groups = array_unique($groups);

        $question->groups = $groups;
        $question->question_answers = $question_answers;

        $parentQuestions = DB::table('question_answers')->where('mid_question_id', '!=', $id)->get();

        $midQuestionIds = $parentQuestions->pluck('mid_question_id')->unique()->toArray();
        $midAnswerIds = $parentQuestions->pluck('mid_answer_id')->toArray();

        $midQuestions = MidQuestions::whereIn('id', $midQuestionIds)->get();
        $midAnswers = MidAnswers::whereIn('id', $midAnswerIds)->get();


        return view('admin.questions.edit', compact('question', 'parentQuestions', 'midQuestions', 'midAnswers', 'parent_question_answer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'sort_order' => 'nullable|integer',
            'groups' => 'required|array',
            'answers' => 'required|array',
            'answer_type' => 'required|array',
            'parent_question_id' => 'nullable|integer',
            'parent_answer_id' => 'nullable|integer',
        ]);

        if ($request->input('parent_question_id') && $request->input('parent_answer_id')) {
            $questionAnswer = DB::table('question_answers')
                ->where('mid_question_id', $request->input('parent_question_id'))
                ->where('mid_answer_id', $request->input('parent_answer_id'))
                ->first();
        } elseif ($request->input('parent_answer_id') == null) {
            $questionAnswer = DB::table('question_answers')
                ->where('mid_question_id', $request->input('parent_question_id'))
                ->first();
        }

        $question = MidQuestions::findOrFail($id);
        $question->update($request->only('title', 'body', 'sort_order'));

        $question_answers = DB::table('question_answers')
            ->where('mid_question_id', $id)
            ->get();

        if ($request->has('answers')) {
            foreach ($request->input('answers') as $groupName => $groupAnswers) {
                foreach ($groupAnswers as $index => $answerBody) {
                    $answer_id = null;
                    foreach ($question_answers as $question_answer) {
                        if ($question_answer->mid_answer_id == $index && $question_answer->group == $groupName) {
                            $answer_id = $index;
                        }
                    }

                    if ($answer_id) {
                        $answer = MidAnswers::findOrFail($answer_id);
                        $answer->update([
                            'body' => $answerBody,
                            'answer_type' => $request->input('answer_type')[$groupName][$index] ?? null,
                        ]);

                        DB::table('question_answers')
                            ->where('mid_question_id', $id)
                            ->where('mid_answer_id', $answer_id)
                            ->update(['group' => $groupName, 'parent_id' => $questionAnswer->id ?? null]);
                    } else {
                        $answer = MidAnswers::create([
                            'body' => $answerBody,
                            'answer_type' => $request->input('answer_type')[$groupName][$index] ?? null,
                        ]);
                        $question->answers()->attach($answer->id, ['group' => $groupName, 'parent_id' => $questionAnswer->id ?? null]);
                    }

                }
            }
        }

        return redirect()->route('question.index')->with('success', 'Question and answers updated successfully.');
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

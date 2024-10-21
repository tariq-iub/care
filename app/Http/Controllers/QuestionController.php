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
        $questions = MidQuestions::with('answers')->get()->sortBy('sort_order');

        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'sort_order' => 'nullable|integer',
            'groups' => 'required|array',
            'answers' => 'required|array',
        ]);

        $question = MidQuestions::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        if ($request->has('answers')) {
            foreach ($request->input('answers') as $groupName => $groupAnswers) {
                foreach ($groupAnswers as $index => $answerDetails) {
                    $answer = MidAnswers::create([
                        'body' => $answerDetails['body'],
                        'answer_type' => $answerDetails['type'],
                    ]);
                    if ($answerDetails['type'] == 'radio') {
                        $answer->update([
                            'radio_group' => $answerDetails['radio_value'],
                        ]);
                    } else if ($answerDetails['type'] == 'number' || $answerDetails['type'] == 'text') {
                        $answer->update([
                            'input_count' => $answerDetails['input_count'],
                        ]);
                    }
                    $question->answers()->attach($answer->id, ['group' => $groupName]);
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

        foreach ($question_answers as $question_answer) {
            $groups[] = $question_answer->group;
        }

        $groups = array_unique($groups);

        $question->groups = $groups;
        $question->question_answers = $question_answers;

        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'sort_order' => 'nullable|integer',
            'groups' => 'required|array',
            'answers' => 'required|array',
        ]);

        $question = MidQuestions::findOrFail($id);
        $question->update($request->only('title', 'body', 'sort_order'));

        $question_answers = DB::table('question_answers')
            ->where('mid_question_id', $id)
            ->get();

        $requestAnswerIds = [];
        $requestAnswerGroups = [];

        if ($request->has('answers')) {
            foreach ($request->input('answers') as $groupName => $groupAnswers) {
                foreach ($groupAnswers as $index => $answerDetails) {
                    $requestAnswerIds[] = $index;
                    $requestAnswerGroups[] = $groupName;
                    $question_answer = $question_answers
                        ->where('mid_answer_id', $index)
                        ->where('group', $groupName)
                        ->first();
                    if ($question_answer) {
                        MidAnswers::where('id', $index)->update([
                            'body' => $answerDetails['body'],
                            'answer_type' => $answerDetails['type'],
                        ]);
                        if ($answerDetails['type'] == 'radio') {
                            MidAnswers::where('id', $index)->update([
                                'radio_group' => $answerDetails['radio_value'],
                            ]);
                        } else if ($answerDetails['type'] == 'number' || $answerDetails['type'] == 'text') {
                            MidAnswers::where('id', $index)->update([
                                'input_count' => $answerDetails['input_count'],
                            ]);
                        }
                        DB::table('question_answers')
                            ->where('mid_question_id', $id)
                            ->where('mid_answer_id', $index)
                            ->update(['group' => $groupName]);
                    } else {
                        $answer = MidAnswers::create([
                            'body' => $answerDetails['body'],
                            'answer_type' => $answerDetails['type']
                        ]);
                        if ($answerDetails['type'] == 'radio') {
                            $answer->update([
                                'radio_group' => $answerDetails['radio_value'],
                            ]);
                        } else if ($answerDetails['type'] == 'number' || $answerDetails['type'] == 'text') {
                            $answer->update([
                                'input_count' => $answerDetails['input_count'],
                            ]);
                        }
                        $question->answers()->attach($answer->id, ['group' => $groupName]);
                    }
                }
            }
        }

        foreach ($question_answers as $question_answer) {
            if (!in_array($question_answer->mid_answer_id, $requestAnswerIds)) {
                DB::table('question_answers')
                    ->where('mid_question_id', $id)
                    ->where('mid_answer_id', $question_answer->mid_answer_id)
                    ->delete();
                MidAnswers::where('id', $question_answer->mid_answer_id)->delete();
            }
            if (!in_array($question_answer->group, $requestAnswerGroups)) {
                DB::table('question_answers')
                    ->where('mid_question_id', $id)
                    ->where('mid_answer_id', $question_answer->mid_answer_id)
                    ->delete();
                MidAnswers::where('id', $question_answer->mid_answer_id)->delete();
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

        $childQuestions = MidQuestions::where('id', '!=', $id)->get();

        return response()->json(['question' => $question, 'question_answers' => $question_answers, 'childQuestions' => $childQuestions]);
    }

    public function linkChildQuestion(Request $request)
    {
        $request->validate([
            'parent_question_id' => 'required|integer',
            'parent_answer_id' => 'nullable|integer',
            'child_question_id' => 'required|integer',
        ]);

        $childQuestionAnswer = DB::table('question_answers')
            ->where('mid_question_id', $request->input('child_question_id'))
            ->first();

        if ($request->input('parent_answer_id')) {
            DB::table('question_answers')
                ->where('mid_question_id', $request->input('parent_question_id'))
                ->where('mid_answer_id', $request->input('parent_answer_id'))
                ->update(['child_id' => $childQuestionAnswer->id]);
        } else {
            DB::table('question_answers')
                ->where('mid_question_id', $request->input('parent_question_id'))
                ->update(['child_id' => $childQuestionAnswer->id]);
        }

        return redirect()->route('question.index')->with('success', 'Child question linked successfully.');
    }
}


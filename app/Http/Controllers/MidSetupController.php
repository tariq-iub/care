<?php

namespace App\Http\Controllers;

use App\Models\MidQuestions;
use App\Models\MidSetup;
use App\Models\MidSetupAnswers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidSetupController extends Controller
{
    public function index()
    {
        $midSetups = MidSetup::with('bodies')->get();
        return view('admin.mid_setup.index', compact('midSetups'));
    }

    public function create()
    {
        $questions = MidQuestions::with('answers')->get()->sortBy('sort_order');

        $childQuestions = DB::table('question_answers')
            ->whereNotNull('child_id')
            ->pluck('mid_question_id')
            ->unique()
            ->toArray();

        foreach ($questions as $question) {
            $question_answers = DB::table('question_answers')
                ->where('mid_question_id', $question->id)
                ->get();

            $groups = [];
            foreach ($question_answers as $answer) {
                $groups[] = $answer->group;
            }

            $groups = array_unique($groups);

            $question->groups = $groups;
            $question->group_count = count($groups);
            $question->question_answers = $question_answers;
        }

        $questions = $questions->reject(function ($question) use ($childQuestions) {
            if (in_array($question->id, $childQuestions)) {
                $questionAnswerIds = DB::table('question_answers')
                    ->where('mid_question_id', $question->id)
                    ->pluck('id')
                    ->toArray();
                $childIds = DB::table('question_answers')
                    ->whereIn('child_id', $questionAnswerIds)
                    ->pluck('mid_question_id')
                    ->toArray();
                return count($childIds) > 0;
            } else {
                return true;
            }
        });

        return view('admin.mid_setup.create', compact('questions', 'childQuestions' ));
    }

    public function edit($id)
    {
        $midSetup = MidSetup::with('bodies')->findOrFail($id);
        $midSetupAnswers = MidSetupAnswers::where('mid_setup_id', $midSetup->id)->get();
        $questionIds = $midSetupAnswers->pluck('mid_question_id')->unique()->toArray();
        $questions = MidQuestions::with('answers')->get()->sortBy('sort_order');

        $questions = $questions->reject(function ($question) use ($questionIds) {
            return !in_array($question->id, $questionIds);
        });

        foreach ($questions as $question) {
            $relatedAnswers = $midSetupAnswers->where('mid_question_id', $question->id);
            if ($relatedAnswers->count() > 1){
                $questionAnswersRelation = [];
                foreach ($relatedAnswers as $answer) {
                    if (str_contains($answer->value, ',')) {
                        $answerValue = explode(',', $answer->value);
                        $questionAnswersRelation[$answer->mid_answer_id.$answerValue[0]] = $answerValue[1];
                    } else {
                        $questionAnswersRelation[$answer->mid_answer_id] = $answer->value;
                    }
                }
                $question->selected_answer = $questionAnswersRelation;
            } elseif ($relatedAnswers->count() == 1) {
                $question->selected_answer = [$relatedAnswers->first()->mid_answer_id => $relatedAnswers->first()->value];
            }

            $question_answers = DB::table('question_answers')
                ->where('mid_question_id', $question->id)
                ->get();

            $groups = [];
            foreach ($question_answers as $answer) {
                $groups[] = $answer->group;
            }

            $groups = array_unique($groups);

            $question->groups = $groups;
            $question->group_count = count($groups);
            $question->question_answers = $question_answers;
        }

        return view('admin.mid_setup.edit', compact('midSetup', 'midSetupAnswers', 'questions', 'questionIds'));
    }

    public function show($id)
    {
        $midSetup = MidSetup::with('bodies')->findOrFail($id);
        $midSetupAnswers = MidSetupAnswers::where('mid_setup_id', $midSetup->id)->get();
        $questionIds = $midSetupAnswers->pluck('mid_question_id')->unique()->toArray();
        $questions = MidQuestions::with('answers')->get()->sortBy('sort_order');

        $questions = $questions->reject(function ($question) use ($questionIds) {
            return !in_array($question->id, $questionIds);
        });

        foreach ($questions as $question) {
            $relatedAnswers = $midSetupAnswers->where('mid_question_id', $question->id);
            if ($relatedAnswers->count() > 1){
                $questionAnswersRelation = [];
                foreach ($relatedAnswers as $answer) {
                    if (str_contains($answer->value, ',')) {
                        $answerValue = explode(',', $answer->value);
                        $questionAnswersRelation[$answer->mid_answer_id.$answerValue[0]] = $answerValue[1];
                    } else {
                        $questionAnswersRelation[$answer->mid_answer_id] = $answer->value;
                    }
                }
                $question->selected_answer = $questionAnswersRelation;
            } elseif ($relatedAnswers->count() == 1) {
                $question->selected_answer = [$relatedAnswers->first()->mid_answer_id => $relatedAnswers->first()->value];
            }

            $question_answers = DB::table('question_answers')
                ->where('mid_question_id', $question->id)
                ->get();

            $groups = [];
            foreach ($question_answers as $answer) {
                $groups[] = $answer->group;
            }

            $groups = array_unique($groups);

            $question->groups = $groups;
            $question->group_count = count($groups);
            $question->question_answers = $question_answers;
        }

        return view('admin.mid_setup.show', compact('midSetup', 'midSetupAnswers', 'questions'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $groupedData = [];
        $currentQuestion = null;

        foreach ($data as $key => $value) {
            if (strpos($key, 'question') === 0) {
                $currentQuestion = $value;

                $groupedData[$currentQuestion] = [
                    'question_id' => $currentQuestion,
                    'answers' => []
                ];
            } elseif ($currentQuestion !== null) {
                $groupedData[$currentQuestion]['answers'][$key] = $value;
            }
        }

        $midSetup = MidSetup::create([
            'title' => $data['midName'],
        ]);

        foreach ($groupedData as $question) {
            foreach ($question['answers'] as $key => $value) {
                if (str_starts_with($key, 'flexRadioDefault')) {
                    MidSetupAnswers::create([
                        'mid_setup_id' => $midSetup->id,
                        'mid_question_id' => $question['question_id'],
                        'mid_answer_id' => $value,
                    ]);
                } else {
                    $keyParts = preg_split('/(\d+)/', $key, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                    if (count($keyParts) >= 4) {
                        $value = $keyParts[3] . ',' . $value;
                    }
                    MidSetupAnswers::create([
                        'mid_setup_id' => $midSetup->id,
                        'mid_question_id' => $question['question_id'],
                        'mid_answer_id' => $keyParts[1],
                        'value' => $value,
                    ]);
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Mid setup created successfully']);
    }

    public function update(Request $request, $id)
    {
        $inputData = $request->all();
        $groupedData = [];
        $currentQuestion = null;

        foreach ($inputData as $key => $value) {
            if (strpos($key, 'question') === 0) {
                $currentQuestion = $value;

                $groupedData[$currentQuestion] = [
                    'question_id' => $currentQuestion,
                    'answers' => []
                ];
            } elseif ($currentQuestion !== null) {
                $groupedData[$currentQuestion]['answers'][$key] = $value;
            }
        }

        $midSetup = MidSetup::findOrFail($id);
        $midSetup->update([
            'title' => $inputData['midName'],
        ]);

        $midSetupAnswers = MidSetupAnswers::where('mid_setup_id', $midSetup->id)->get();

        $questionIds = $midSetupAnswers->pluck('mid_question_id')->unique()->toArray();
        $requestQuestionIds = [];

        foreach ($groupedData as $question) {
            $requestQuestionIds[] = $question['question_id'];
            foreach ($question['answers'] as $key => $value) {
                if (str_starts_with($key, 'flexRadioDefault')) {
                    MidSetupAnswers::where('mid_setup_id', $midSetup->id)
                        ->where('mid_question_id', $question['question_id'])
                        ->where('value', "=", null)
                        ->delete();
                }
            }
        }

        $deleteQuestionIds = array_diff($questionIds, $requestQuestionIds);

        foreach ($groupedData as $question) {
            foreach ($question['answers'] as $key => $value) {
                if (str_starts_with($key, 'flexRadioDefault')) {
                    MidSetupAnswers::create([
                        'mid_setup_id' => $midSetup->id,
                        'mid_question_id' => $question['question_id'],
                        'mid_answer_id' => $value,
                    ]);
                } else {
                    $keyParts = preg_split('/(\d+)/', $key, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                    if (count($keyParts) >= 4) {
                        $value = $keyParts[3] . ',' . $value;
                    }

                    $midSetupAnswer = MidSetupAnswers::where('mid_setup_id', $midSetup->id)
                        ->where('mid_question_id', $question['question_id'])
                        ->where('mid_answer_id', $keyParts[1])
                        ->get();

                    if (count($midSetupAnswer) >= 1) {
                        for ($i = 0; $i < count($midSetupAnswer); $i++) {
                            if (str_contains($midSetupAnswer[$i]->value, ',')) {
                                $value_parts = explode(',', $midSetupAnswer[$i]->value);
                                if ($value_parts[0] == $keyParts[3]) {
                                    $midSetupAnswer[$i]->update([
                                        'value' => $value,
                                    ]);
                                }
                            }
                        }
                    } else {
                        MidSetupAnswers::create([
                            'mid_setup_id' => $midSetup->id,
                            'mid_question_id' => $question['question_id'],
                            'mid_answer_id' => $keyParts[1],
                            'value' => $value,
                        ]);
                    }
                }
            }
        }

        foreach ($deleteQuestionIds as $questionId) {
            $midSetupAnswers = MidSetupAnswers::where('mid_setup_id', $midSetup->id)
                ->where('mid_question_id', $questionId)
                ->get();
            $midSetupAnswers->each->delete();
        }

        return response()->json(['success' => true, 'message' => 'Mid setup updated successfully']);
    }

    public function destroy($id)
    {
        $midSetup = MidSetup::findOrFail($id);

        $midSetupAnswers = MidSetupAnswers::where('mid_setup_id', $midSetup->id)->get();
        $midSetupAnswers->each->delete();

        $midSetup->delete();

        return redirect()->route('mid-setups.index');
    }

    public function fetchChildQuestion(Request $request)
    {
        $requestData = $request->all();
        if (isset($requestData['answer_id'])) {
            $question_answer = DB::table('question_answers')
                ->where('mid_question_id', $requestData['question_id'])
                ->where('mid_answer_id', $requestData['answer_id'])
                ->first();
        } else {
            $question_answer = DB::table('question_answers')
            ->where('mid_question_id', $requestData['question_id'])
            ->first();
        }

        $child_question_answer = DB::table('question_answers')
            ->where('id', $question_answer->child_id)
            ->pluck('mid_question_id')
            ->unique()
            ->toArray();

        $child_questions = MidQuestions::with('answers')->where('id', $child_question_answer)->get();

        $question_answers = DB::table('question_answers')
            ->where('mid_question_id', $child_questions[0]->id)
            ->get();

        foreach ($child_questions as $question) {
            $groups = [];
            foreach ($question_answers as $answer) {
                $groups[] = $answer->group;
            }
            $groups = array_unique($groups);

            $question->groups = $groups;
            $question->group_count = count($groups);
            $question->question_answers = $question_answers;
        }

        $question_id = $child_questions[0]->id;
        $groups = $child_questions[0]->groups;
        $group_count = $child_questions[0]->group_count;
        $title = $child_questions[0]->title;
        $body = $child_questions[0]->body;
        $answers = $child_questions[0]->answers;
        $question_answers = $child_questions[0]->question_answers;

        return view('admin.mid_setup.partials.question_form', compact('question_id', 'groups', 'group_count', 'title', 'body', 'answers', 'question_answers'));
    }
}

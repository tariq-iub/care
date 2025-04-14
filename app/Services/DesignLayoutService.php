<?php

namespace App\Services;


use App\Models\MidSetup;
use App\Models\MidSetupAnswers;
use App\Models\MidQuestions;
use App\Models\MidAnswers;
use Illuminate\Support\Facades\DB;

class DesignLayoutService
{
    public function getMachineDesignLayout($midSetupId)
    {
        $components = [];
        $questions = [];
        $answers = [];
        $midSetup = MidSetup::find($midSetupId);
        if ($midSetup){
            $midSetupAnswers = MidSetupAnswers::where('mid_setup_id', $midSetupId)->get();
        }

        foreach ($midSetupAnswers as $midSetupAnswer) {
            $question = MidQuestions::find($midSetupAnswer->mid_question_id);
            $answer = MidAnswers::find($midSetupAnswer->mid_answer_id);

            $questions[] = $question;
            $answers[] = $answer;
        }

        foreach ($questions as $q) {
            $current_answers = [];

            foreach ($answers as $a) {
                $question_answers = DB::table('question_answers')
                    ->where('mid_question_id', $q->id)
                    ->where('mid_answer_id', $a->id)
                    ->get();

                foreach ($question_answers as $qa) {
                    $current_answer = MidAnswers::find($qa->mid_answer_id);
                    if ($current_answer) {
                        $current_answers[] = $current_answer->body;
                    }
                }
            }

            foreach ($question_answers as $qa) {
                $current_answer = MidAnswers::find($qa->mid_answer_id);
                $current_answers[] = $current_answer->body;
            }
            $question_type = DB::table('mid_question_type')->where('mid_question_id', $q->id)->first();
            if ($question_type && $question_type->type != null) {
                if ($question_type->type == 'drive') {
                    $components['drive'] = $current_answers;
                } elseif ($question_type->type == 'coupling') {
                    $components['coupling'] = $current_answers;
                } elseif ($question_type->type == 'driven') {
                    $components['driven'] = $current_answers;
                }
            }
        }


        return $components;
    }
}

<?php

namespace App\Services;


use App\Models\MidSetup;
use App\Models\MidSetupAnswers;
use App\Models\MidQuestions;
use App\Models\MidAnswers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DesignLayoutService
{
    public function getMachineDesignLayout($midSetupId)
    {
        $components = [];
        $midSetup = MidSetup::find($midSetupId);

        if ($midSetup) {
            $midSetupAnswers = MidSetupAnswers::where('mid_setup_id', $midSetupId)->get();

            $questionTypeRows = DB::table('mid_question_type')
                ->whereIn('mid_question_id', $midSetupAnswers->pluck('mid_question_id'))
                ->get();

            // Separate component definitions (mid_answer_id is null) and bearings
            $componentDefs = $questionTypeRows->whereNull('mid_answer_id')->keyBy('mid_question_id');
            $bearingDefs = $questionTypeRows->whereNotNull('mid_answer_id');

            foreach ($midSetupAnswers as $setupAnswer) {
                $questionId = $setupAnswer->mid_question_id;
                $answerId = $setupAnswer->mid_answer_id;

                if (!isset($componentDefs[$questionId])) {
                    continue; // not a component definition
                }

                $type = $componentDefs[$questionId]->type;

                $answer = MidAnswers::find($answerId);
                if ($answer && in_array($type, ['drive', 'coupling', 'driven'])) {
                    $components[$type]['answer'] = $answer->body;
                }
            }

            foreach ($bearingDefs as $bearingDef) {
                $questionId = $bearingDef->mid_question_id;
                $answerId = $bearingDef->mid_answer_id;

                $type = $bearingDef->type;
                $answer = MidSetupAnswers::where('mid_setup_id', $midSetupId)
                    ->where('mid_question_id', $questionId)
                    ->where('mid_answer_id', $answerId)
                    ->first();

                Log::info('Answer:', ['answer' => $answer]);
                // input_count is in format (0,2) or (0,1), need to get 2 or 1
                $input_count = $answer ? explode(',', $answer->value)[1] : null;

                if ($answer && in_array($type, ['drive', 'coupling', 'driven'])) {
                    $components[$type]['bearing_count'] = $input_count;
                }
            }
        }

        return $components;
    }
}

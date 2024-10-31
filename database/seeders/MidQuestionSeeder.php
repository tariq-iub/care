<?php

namespace Database\Seeders;

use App\Models\MidAnswers;
use App\Models\MidQuestions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MidQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionsWithAnswers = [
            [
                'title' => 'Drive Type of Component',
                'body' => 'What Type of component drives this machine?',
                'sort_order' => 1,
                'answers' => [
                    ['body' => 'Motor Driven', 'answer_type' => 'radio'],
                    ['body' => 'Turbine Driven(including turbo-chargers)', 'answer_type' => 'radio'],
                    ['body' => 'Diesel engine driven', 'answer_type' => 'radio'],
                    ['body' => 'The Driver is not monitored', 'answer_type' => 'radio'],
                ],
            ],
            [
                'title' => 'Type of Motor Driven Machine',
                'body' => 'Select between these different types of motor driven machines',
                'sort_order' => 2,
                'answers' => [
                    ['body' => 'Motor is close-coupled to a pump, fan or compressor', 'answer_type' => 'radio'],
                    ['body' => 'Default - Motor is flex-coupled to, or otherwise driving, another monitored component', 'answer_type' => 'radio'],
                    ['body' => 'Motor driving an integrated oil purifier assembly', 'answer_type' => 'radio'],
                    ['body' => 'Motor is the only component being monitored', 'answer_type' => 'radio'],
                ],
            ],
            [
                'title' => 'Motor Setup',
                'body' => 'Describe the motor. Please ensure that you check each page and answer as many questions as possible.',
                'sort_order' => 3,
                'answers' => [
                    ['body' => 'Bearing Position Number', 'answer_type' => 'number', 'input_count' => 2],
                    ['body' => 'AC Motor', 'answer_type' => 'radio'],
                    ['body' => 'DC Motor', 'answer_type' => 'radio'],
                    ['body' => 'VFD Motor', 'answer_type' => 'radio'],
                    ['body' => 'Cooling Fans on Motor?', 'answer_type' => 'checkbox'],
                    ['body' => 'Number of motor bars', 'answer_type' => 'number'],
                    ['body' => 'Rolling Element Bearings', 'answer_type' => 'radio', 'group' => 'bearing'],
                    ['body' => 'Sleeve Bearing', 'answer_type' => 'radio', 'group' => 'bearing'],
                ],
            ],
            [
                'title' => 'Coupled Component',
                'body' => 'How is this component coupled to the next component?',
                'sort_order' => 4,
                'answers' => [
                    ['body' => 'Flexible Coupling', 'answer_type' => 'radio'],
                    ['body' => 'No Coupling or Solid Coupling', 'answer_type' => 'radio'],
                    ['body' => 'Belt Driven', 'answer_type' => 'radio'],
                    ['body' => 'Chain Driven', 'answer_type' => 'radio'],
                    ['body' => 'Fluid Coupling', 'answer_type' => 'radio'],
                    ['body' => 'Magnetic Coupling', 'answer_type' => 'radio'],
                ],
            ],
            [
                'title' => 'Gearbox Setup',
                'body' => 'If you have a gearbox, choose between these options.',
                'sort_order' => 5,
                'answers' => [
                    ['body' => 'Single stage gearbox', 'answer_type' => 'radio'],
                    ['body' => 'Two stage gearbox', 'answer_type' => 'radio'],
                    ['body' => 'Multi stage gearbox', 'answer_type' => 'radio'],
                    ['body' => 'There is no gearbox', 'answer_type' => 'radio'],
                ],
            ],
            [
                'title' => 'Driven Component',
                'body' => 'What is being driven by your component?',
                'sort_order' => 6,
                'answers' => [
                    ['body' => 'Pump: centrifugal, piston and others', 'answer_type' => 'radio'],
                    ['body' => 'Single or multi-stage fan', 'answer_type' => 'radio'],
                    ['body' => 'Compressor: centrifugal, reciprocating, screw and others', 'answer_type' => 'radio'],
                    ['body' => 'Electric generator', 'answer_type' => 'radio'],
                    ['body' => 'Machine tool spindle/chuck or shaft', 'answer_type' => 'radio'],
                    ['body' => 'We are not monitoring a driven component', 'answer_type' => 'radio'],
                ],
            ],
            [
                'title' => 'Pump Type',
                'body' => 'Select the type of pump',
                'sort_order' => 7,
                'answers' => [
                    ['body' => 'Centrifugal pump', 'answer_type' => 'radio'],
                    ['body' => 'Axial flow propeller pump', 'answer_type' => 'radio'],
                    ['body' => 'Rotary thread pump', 'answer_type' => 'radio'],
                    ['body' => 'Rotary Screw pump', 'answer_type' => 'radio'],
                    ['body' => 'Rotary gear pump', 'answer_type' => 'radio'],
                    ['body' => 'Rotary sliding vane pump', 'answer_type' => 'radio'],
                    ['body' => 'Piston pump', 'answer_type' => 'radio'],
                ],
            ],
            [
                'title' => 'Pump Setup',
                'body' => 'Describe the pump. Please ensure that you check each page and answer as many questions as possible.',
                'sort_order' => 8,
                'answers' => [
                    ['body' => 'Bearing Position Number', 'answer_type' => 'number', 'input_count' => 2],
                    ['body' => 'Overhung Rotor', 'answer_type' => 'checkbox'],
                    ['body' => 'Number of vanes 1', 'answer_type' => 'number'],
                    ['body' => 'Number of vanes 2', 'answer_type' => 'number'],
                    ['body' => 'Rolling elements bearing', 'answer_type' => 'radio', 'group' => 'bearing', 'radio_group' => 'Main bearing type'],
                    ['body' => 'Sleeve Bearing', 'answer_type' => 'radio', 'group' => 'bearing', 'radio_group' => 'Main bearing type'],
                    ['body' => 'Rolling element', 'answer_type' => 'radio', 'group' => 'bearing', 'radio_group' => 'Thrust bearing type'],
                    ['body' => 'Sleeve thrust', 'answer_type' => 'radio', 'group' => 'bearing', 'radio_group' => 'Thrust bearing type'],
                    ['body' => 'No thrust bearing', 'answer_type' => 'radio', 'group' => 'bearing', 'radio_group' => 'Thrust bearing type'],
                ],
            ],
            [
                'title' => 'Setup Completed',
                'body' => 'Congratulations',
                'sort_order' => 0,
                'answers' => [
                    ['body' => "That's all there is to it. Press save to save this MID.", 'group'=>'finish', 'answer_type' => 'null'],
                ],
            ],
        ];

        foreach ($questionsWithAnswers as $qwa) {
            $question = MidQuestions::create([
                'title' => $qwa['title'],
                'body' => $qwa['body'],
                'sort_order' => $qwa['sort_order'],
            ]);

            foreach ($qwa['answers'] as $answerData) {
                $answer = MidAnswers::create(
                    [
                        'body' => $answerData['body'],
                        'answer_type' => $answerData['answer_type'],
                        'input_count' => $answerData['input_count'] ?? null,
                        'radio_group' => $answerData['radio_group'] ?? null,
                    ]
                );

                DB::table('question_answers')->insert([
                    'mid_question_id' => $question->id,
                    'mid_answer_id' => $answer->id,
                    'group' =>  $answerData['group'] ?? 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

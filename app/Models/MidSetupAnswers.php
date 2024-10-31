<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidSetupAnswers extends Model
{
    use HasFactory;

    protected $fillable = ['mid_setup_id', 'mid_question_id', 'mid_answer_id', 'value'];

    public function midSetup()
    {
        return $this->belongsTo(MidSetup::class);
    }

    public function midQuestion()
    {
        return $this->belongsTo(MidQuestions::class);
    }

    public function midAnswer()
    {
        return $this->belongsTo(MidAnswers::class);
    }
}

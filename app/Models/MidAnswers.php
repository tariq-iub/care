<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidAnswers extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'answer_type', 'input_count', 'radio_group'];

    public function question()
    {
        return $this->belongsToMany(MidQuestions::class, 'question_answers', 'mid_answer_id', 'mid_question_id' );
    }
}

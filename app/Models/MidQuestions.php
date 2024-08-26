<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidQuestions extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'sort_order'];

    public function answers()
    {
        return $this->belongsToMany(MidAnswers::class, 'question_answers', 'mid_question_id', 'mid_answer_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidSetupBody extends Model
{
    use HasFactory;

    protected $fillable = ['mid_setup_id', 'question_answer_id'];

    public function midSetup()
    {
        return $this->belongsTo(MidSetup::class);
    }

}

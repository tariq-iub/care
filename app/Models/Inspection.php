<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Inspection extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = [
        'title',
        'inspection_type',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function survey()
    {
        return $this->hasOne(Survey::class);
    }
}

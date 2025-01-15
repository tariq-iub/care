<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'plant_id',
        'name',
        'line_frequency',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}

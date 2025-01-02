<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineProcessPoint extends Model
{
    use HasFactory;

    protected $fillable = ['machine_id', 'is_points_enabled', 'point_name', 'id_tag'];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}

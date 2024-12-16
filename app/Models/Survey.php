<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_name',
        'survey_type',
        'scheduled_at',
        'taken_up',
        'status',
        'inspection_id',
        'engineer_id',
    ];

    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }

    public function engineer()
    {
        return $this->belongsTo(User::class, 'engineer_id');
    }

    public function machines()
    {
        return $this->belongsToMany(MachineInfo::class, 'survey_machine', 'survey_id', 'machine_id');
    }
}

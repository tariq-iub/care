<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineVibrationLocations extends Model
{
    use HasFactory;

    protected $fillable = ['machine_id', 'location_name', 'position', 'id_tag', 'orientation'];

    public function machineInfo()
    {
        return $this->belongsTo(Machine::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineVibrationLocations extends Model
{
    use HasFactory;

    protected $fillable = ['machine_id', 'location_name', 'position', 'id_tag', 'orientation'];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function dataFile()
    {
        return $this->hasOne(DataFile::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['mid_setup_id', 'plant_id', 'area_id', 'machine_name'];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function midSetup()
    {
        return $this->belongsTo(MidSetup::class);
    }

    public function surveys()
    {
        return $this->belongsToMany(Survey::class, 'survey_machine', 'machine_id', 'survey_id');
    }

    public function vibrationLocations()
    {
        return $this->hasMany(MachineVibrationLocation::class);
    }

    public function dataFiles()
    {
        return $this->hasMany(DataFile::class);
    }
}

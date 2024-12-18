<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class DataFile extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['file_name', 'file_path', 'site_id', 'device_id', 'inspection_id'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function machineVibrationLocations()
    {
        return $this->belongsTo(MachineVibrationLocations::class);
    }
}

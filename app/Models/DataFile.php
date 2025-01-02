<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class DataFile extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['file_name', 'file_path', 'machine_id', 'device_id', 'vibration_location_id'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function machineVibrationLocation()
    {
        return $this->belongsTo(MachineVibrationLocation::class, 'vibration_location_id');
    }
}

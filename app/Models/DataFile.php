<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class DataFile extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['file_name', 'file_path',  'device_id', 'machine_id', 'vibration_location_id'];

//    public function inspection()
//    {
//        return $this->belongsTo(Inspection::class);
//    }
//
//    public function component()
//    {
//        return $this->belongsTo(Component::class);
//    }
//
//    public function area()
//    {
//        return $this->belongsTo(Area::class);
//    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function vibrationlocation()
    {
        return $this->belongsTo(MachineVibrationLocations::class);
    }
}

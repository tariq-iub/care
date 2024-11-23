<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidGenerals extends Model
{
    use HasFactory;

    protected $fillable = ['mid_setup_id', 'nominal_speed', 'speed_unit', 'secondary_speed_ratio', 'mid_rating', 'machine_orientation'];

    public function midSetup()
    {
        return $this->belongsTo(MidSetup::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidComponents extends Model
{
    use HasFactory;

    protected $fillable = ['mid_setup_id', 'component_code', 'description', 'pickup_code', 'bearings_monitored'];

    public function midSetup()
    {
        return $this->belongsTo(MidSetup::class);
    }
}

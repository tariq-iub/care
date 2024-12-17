<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ForcingFrequencies extends Model
{
    use HasFactory;

    protected $fillable = ['mid_setup_id', 'code', 'multiple', 'name', 'on_secondary', 'elements', 'final_ratio'];

    public function midSetup()
    {
        return $this->belongsTo(MidSetup::class);
    }
}

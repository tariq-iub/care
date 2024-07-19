<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = [
        'data_file_id',
        'X',
        'Y',
        'Z',
    ];

    public function file()
    {
        return $this->belongsTo(DataFile::class);
    }

    public function FFT($file_id, Array $args)
    {
        $fft = [];
        return $fft;
    }
}

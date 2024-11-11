<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Inspection extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = [
        'title',
        'type',
        'scheduled_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function dataFiles()
    {
        return $this->hasMany(DataFile::class);
    }
}

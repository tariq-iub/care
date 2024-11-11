<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Component extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['title', 'type', 'site_id'];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function dataFiles()
    {
        return $this->hasMany(DataFile::class);
    }
}

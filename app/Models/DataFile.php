<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class DataFile extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['file_name', 'file_path', 'site_id'];

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Role extends Model
{
    use HasFactory;
    Use Loggable;

    protected $fillable = [
        'title',
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menus_roles');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidSetup extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function bodies()
    {
        return $this->hasMany(MidSetupBody::class);
    }

}

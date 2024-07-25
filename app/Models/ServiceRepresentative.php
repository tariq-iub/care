<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRepresentative extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'address',
        'service_rep_name',
        'phone',
        'fax',
        'email',
    ];
}

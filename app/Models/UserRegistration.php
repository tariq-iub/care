<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserRegistration extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'phone_no',
        'company_name',
        'company_address',
        'company_city',
        'responder_id',
        'remarks',
        'user_created_at',
        'company_registration_date',
        'client_emailed',
        'client_registered',
    ];
}

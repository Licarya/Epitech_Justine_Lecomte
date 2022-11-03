<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAlert extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'firstname',
        'lastname',
        'phone',
        'message',
        'job_alerts_id',
        'users_id',
    ];
}

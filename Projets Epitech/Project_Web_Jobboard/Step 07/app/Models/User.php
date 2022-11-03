<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'role',
        'password',
        'email',
        'firstname',
        'lastname',
        'age',
        'description',
        'phone',
        'cv',
    ];
}

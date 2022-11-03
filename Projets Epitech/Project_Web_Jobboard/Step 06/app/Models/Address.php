<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'country',
        'city',
        'postal_code',
        'address1',
        'address2',
        'users_id',
    ];
}

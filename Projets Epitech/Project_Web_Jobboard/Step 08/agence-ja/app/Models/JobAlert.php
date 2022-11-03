<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAlert extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'job_type',
        'content',
        'wage',
        'companies_id',
        'secteur',
        'wage_type',
    ];
}

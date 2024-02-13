<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplySocieties extends Model
{
    use HasFactory;

    protected $fillable = [
        'notes',
        'date',
        'society_id',
        'job_vacancy_id',	
    ];
}

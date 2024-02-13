<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplyPositions extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'society_id',
        'job_vacancy_id',
        'position_id',
        'job_apply_societies_id',
        'status',	
    ];

    public function jobApplySocieties()
    {
        return $this->belongsTo(JobApplySocieties::class);
    }
}

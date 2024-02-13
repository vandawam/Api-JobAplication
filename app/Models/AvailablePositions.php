<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailablePositions extends Model
{
    use HasFactory;

    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class);
    }
}

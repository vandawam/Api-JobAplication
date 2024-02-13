<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function availables()
    {
        return $this->hasMany(AvailablePositions::class);
    }
}

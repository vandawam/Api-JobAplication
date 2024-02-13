<?php

// app/Models/Society.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    protected $table = 'societies';
    protected $fillable = ['id_card_number', 'password','login_tokens'];
    public $timestamps = false;

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }
}


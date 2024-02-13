<?php

// app/Models/User.php

use App\Models\Regional;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // ... other fields ...

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }
}

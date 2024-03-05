<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class joined_servers extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->hasMany(users::class);
    }
    public function servers()
    {
        return $this->hasMany(servers::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servers extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasMany(joined_servers::class);
    }
    public function roles()
    {
        return $this->hasMany(roles::class);
    }
    public function user_roles()
    {
        return $this->hasMany(server_roles::class);
    }
    public function channels()
    {
        return $this->hasMany(channels::class);
    }
}

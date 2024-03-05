<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class have_chat extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function servers()
    {
        return $this->hasMany(users::class);
    }
}

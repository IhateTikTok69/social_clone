<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class channels extends Model
{
    use HasFactory;
    public function servers()
    {
        return $this->belongsTo(servers::class);
    }
}

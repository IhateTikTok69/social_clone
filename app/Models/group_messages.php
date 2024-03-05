<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_messages extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(server_roles::class);
    }
    public function channel()
    {
        return $this->belongsTo(server_roles::class);
    }
}

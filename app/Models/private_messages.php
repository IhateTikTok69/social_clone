<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class private_messages extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function chat()
    {
        return $this->belongsTo(conversations::class);
    }
    public function user()
    {
        return $this->belongsTo(users::class);
    }
}

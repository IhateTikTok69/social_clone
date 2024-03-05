<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    use HasFactory;
    protected $guarded = [''];
    public function private_chat()
    {
        return $this->hasMany(private_messages::class);
    }
    public function have_chat()
    {
        return $this->hasMany(have_chat::class);
    }
    public function relationships()
    {
        return $this->hasMany(relationships::class);
    }
    public function public_chat()
    {
        return $this->hasMany(group_messages::class);
    }
    public function joined_servers()
    {
        return $this->hasMany(joined_servers::class);
    }
    public function server_roles()
    {
        return $this->hasMany(server_roles::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'rols';
    protected $fillable = ['rol', 'permiso'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;
    protected $table = 'subcategorias';
    protected $fillable = ['nombre', 'numero'];

    public function disentrenador()
    {
        return $this->hasMany(Disentrenador::class);
    }
}

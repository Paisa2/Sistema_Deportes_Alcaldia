<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;
    protected $table = 'disciplinas';
    protected $fillable = ['disciplina', 'edad_estudiante', 'sexo_estudiante', 'categoria', 'sub_estudiante', 'estado'];

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
}

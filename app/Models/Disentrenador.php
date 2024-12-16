<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disentrenador extends Model
{
    use HasFactory;
    protected $table = 'disentrenadores';
    protected $fillable = ['disciplina', 'edad_estudiante', 'sexo_estudiante', 'categoria', 'sub_estudiante'];

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }
}

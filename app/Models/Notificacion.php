<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;
    protected $table = 'notificaciones';
    protected $fillable = [
        'email',
        'mensaje',
        'dia',
        'solicitud'
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}

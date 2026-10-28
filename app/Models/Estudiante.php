<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estudiante extends Model
{
    // Campos que permitiremos rellenar desde la API
    protected $fillable = ['nombre', 'apellido', 'correo', 'codigo', 'fecha_nacimiento', 'carrera_id'];

    // Relación requerida: Un estudiante pertenece a una carrera (belongsTo)
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }
}

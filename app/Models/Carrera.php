<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrera extends Model
{
    // Campos que permitiremos rellenar desde la API
    protected $fillable = ['nombre', 'codigo', 'facultad', 'duracion_semestres'];

    // Relación requerida: Una carrera tiene muchos estudiantes (hasMany)
    public function estudiantes(): HasMany
    {
        return $this->hasMany(Estudiante::class);
    }
}

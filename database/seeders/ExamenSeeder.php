<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrera;
use App\Models\Estudiante;

class ExamenSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear las 5 carreras obligatorias con tus nuevos campos enteros y strings
        $carreras = [
            Carrera::create(['nombre' => 'Ingeniería de Sistemas', 'codigo' => 'SIS', 'facultad' => 'Ingeniería', 'duracion_semestres' => 10]),
            Carrera::create(['nombre' => 'Medicina Humana', 'codigo' => 'MED', 'facultad' => 'Ciencias de la Salud', 'duracion_semestres' => 14]),
            Carrera::create(['nombre' => 'Derecho y Ciencias Políticas', 'codigo' => 'DER', 'facultad' => 'Derecho', 'duracion_semestres' => 12]),
            Carrera::create(['nombre' => 'Arquitectura y Urbanismo', 'codigo' => 'ARQ', 'facultad' => 'Ingeniería', 'duracion_semestres' => 10]),
            Carrera::create(['nombre' => 'Administración de Empresas', 'codigo' => 'ADM', 'facultad' => 'Ciencias Económicas', 'duracion_semestres' => 10]),
        ];

        // Listas de datos para generar los 15 estudiantes de manera dinámica
        $nombres = ['Juan', 'Maria', 'Carlos', 'Ana', 'Luis', 'Sofia', 'Pedro', 'Laura', 'Diego', 'Elena', 'Jorge', 'Lucia', 'Andres', 'Paula', 'Kevin'];
        $apellidos = ['Perez', 'Gomez', 'Lopez', 'Rodriguez', 'Martinez', 'Sanchez', 'Diaz', 'Fernandez', 'Torres', 'Ruiz', 'Alvarez', 'Suarez', 'Castro', 'Romero', 'Silva'];

        // 2. Crear los 15 estudiantes distribuidos de forma aleatoria en las carreras
        for ($i = 0; $i < 15; $i++) {
            // Generamos una fecha de nacimiento aleatoria coherente
            $ano = rand(1998, 2006);
            $mes = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
            $dia = str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);

            Estudiante::create([
                'nombre' => $nombres[$i],
                'apellido' => $apellidos[$i],
                'correo' => strtolower($nombres[$i] . "." . $apellidos[$i] . "@examen.com"),
                'codigo' => 'EST-' . (2024000 + $i), // Genera códigos únicos tipo EST-2024000, EST-2024001...
                'fecha_nacimiento' => "$ano-$mes-$dia",
                'carrera_id' => $carreras[array_rand($carreras)]->id, // Asigna una de las 5 carreras al azar
            ]);
        }
    }
}

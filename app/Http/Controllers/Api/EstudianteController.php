<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        // Devuelve los estudiantes incluyendo el nombre de su carrera asignada
        return response()->json(Estudiante::with('carrera:id,nombre')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:estudiantes,correo',
            'codigo' => 'required|string|unique:estudiantes,codigo|max:20',
            'fecha_nacimiento' => 'required|date',
            'carrera_id' => 'required|exists:carreras,id' // Si la carrera no existe, devuelve 422
        ]);

        $estudiante = Estudiante::create($validated);
        return response()->json($estudiante, 201);
    }

    public function show($id)
    {
        $estudiante = Estudiante::with('carrera:id,nombre')->find($id);
        if (!$estudiante) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($estudiante, 200);
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) return response()->json(['message' => 'No encontrado'], 404);

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'correo' => 'sometimes|required|email|unique:estudiantes,correo,' . $id,
            'codigo' => 'sometimes|required|string|max:20|unique:estudiantes,codigo,' . $id,
            'fecha_nacimiento' => 'sometimes|required|date',
            'carrera_id' => 'sometimes|required|exists:carreras,id'
        ]);

        $estudiante->update($validated);
        return response()->json($estudiante, 200);
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) return response()->json(['message' => 'No encontrado'], 404);

        $estudiante->delete();
        return response()->json(null, 204);
    }
}

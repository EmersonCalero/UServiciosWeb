<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index()
    {
        return response()->json(Carrera::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|unique:carreras,codigo|max:10',
            'facultad' => 'required|string|max:255',
            'duracion_semestres' => 'required|integer|min:1'
        ]);

        $carrera = Carrera::create($validated);
        return response()->json($carrera, 201);
    }

    public function show($id)
    {
        $carrera = Carrera::find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($carrera, 200);
    }

    public function update(Request $request, $id)
    {
        $carrera = Carrera::find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'codigo' => 'sometimes|required|string|max:10|unique:carreras,codigo,' . $id,
            'facultad' => 'sometimes|required|string|max:255',
            'duracion_semestres' => 'sometimes|required|integer|min:1'
        ]);

        $carrera->update($validated);
        return response()->json($carrera, 200);
    }

    public function destroy($id)
    {
        $carrera = Carrera::find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);

        // Validación 409: Si la carrera tiene estudiantes, bloquea la eliminación
        if ($carrera->estudiantes()->count() > 0) {
            return response()->json(['message' => 'Conflicto: La carrera tiene estudiantes asociados'], 409);
        }

        $carrera->delete();
        return response()->json(null, 204);
    }

    // Punto 6: Endpoint de relación usando Eager Loading (with)
    public function estudiantes($id)
    {
        $carrera = Carrera::with('estudiantes')->find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($carrera, 200);
    }
}

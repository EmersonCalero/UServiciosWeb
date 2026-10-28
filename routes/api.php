<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarreraController;
use App\Http\Controllers\Api\EstudianteController;

// Endpoint de relación personalizado (Punto 6)
Route::get('carreras/{id}/estudiantes', [CarreraController::class, 'estudiantes']);

// CRUD completo vía API Resource (Punto 5)
Route::apiResource('carreras', CarreraController::class);
Route::apiResource('estudiantes', EstudianteController::class);

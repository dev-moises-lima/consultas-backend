<?php

use App\Http\Controllers\ConsultaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Models\Paciente;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('pacientes', [PacienteController::class, 'store']);

Route::get('pacientes', [PacienteController::class, 'obterTodos']);

Route::get('pacientes/{pacienteId}', [PacienteController::class, 'obterUm']);

Route::post('consulta/{pacienteId}', [ConsultaController::class, 'store']);

Route::get('pacientes/{pacienteId}/consultas', [PacienteController::class, 'obterConsultas']);

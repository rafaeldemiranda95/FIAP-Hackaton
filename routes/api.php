<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PontoController;

// Rotas públicas
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::get('/', function () {
    return response()->json([
        'message' => 'Ok'
    ], 200);
});

// Rotas protegidas com autenticação via Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Rota para obter os detalhes do usuário autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Rotas relacionadas a registros de ponto
    Route::prefix('/ponto')->group(function () {
        Route::get('/registros', [PontoController::class, 'visualizarRegistros']);
        Route::post('/registro', [PontoController::class, 'registrar']);
        Route::get('/relatorio', [PontoController::class, 'gerarRelatorio']);
    });
});

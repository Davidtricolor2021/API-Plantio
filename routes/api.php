<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//rota para registro de novo usuário
Route::post('/register', [App\Http\Controllers\Auth\AuthController::class, 'register']);
//rota para login de novo usuário
Route::post('/login', [App\Http\Controllers\Auth\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    //rota para plantio

    Route::get('/plantios', [App\Http\Controllers\PlantioController::class, 'index']); // listar todos
    Route::post('/plantio', [App\Http\Controllers\PlantioController::class, 'store']); // criar
    Route::get('/plantio/{id}', [App\Http\Controllers\PlantioController::class, 'show']); // listar um especifico
    Route::put('/plantio/{id}', [App\Http\Controllers\PlantioController::class, 'update']); // atualizar
    Route::delete('/plantio/{id}', [App\Http\Controllers\PlantioController::class, 'destroy']); // deletar

    //rota para historico

    Route::get('/historicos', [App\Http\Controllers\HistoricoController::class, 'index']);
    Route::post('/historico', [App\Http\Controllers\HistoricoController::class, 'store']);
    Route::get('/historico/{id}', [App\Http\Controllers\HistoricoController::class, 'show']);
    Route::put('/historico/{id}', [App\Http\Controllers\HistoricoController::class, 'update']);
    Route::delete('/historico/{id}', [App\Http\Controllers\HistoricoController::class, 'destroy']);

    //rota para logoff e exclusão de token.
    Route::post('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
});

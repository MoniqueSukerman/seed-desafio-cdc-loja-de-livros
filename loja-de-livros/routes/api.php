<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PaisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/autores', [AutorController::class, 'store']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::post('/livros', [LivroController::class, 'store']);
Route::get('/livros', [LivroController::class, 'index']);
Route::get('/livros/{id}', [LivroController::class, 'show']);
Route::post('/paises', [PaisController::class, 'store']);
Route::post('/estados', [EstadoController::class, 'store']);
Route::post('/compras/dados-cliente', [CompraController::class, 'processarDadosCliente']);
Route::post('/compras/iniciar', [CompraController::class, 'iniciar']);
Route::post('/cupons', [CupomController::class, 'store']);
Route::get('/compras/{id}', [CompraController::class, 'show']);


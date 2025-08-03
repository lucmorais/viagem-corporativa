<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ApiMiddleware;
use App\Http\Middleware\JwtMiddleware;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/registro', [AuthController::class, 'register']);
Route::get('/user', [AuthController::class, 'getUser']);

Route::middleware([ApiMiddleware::class, JwtMiddleware::class])->group(function () {
    Route::get('/pedido', [PedidoController::class, 'index']);
    Route::get('/pedido/{id}', [PedidoController::class, 'show']);
    Route::post('/pedido', [PedidoController::class, 'store']);
    Route::put('/pedido/{id}', [PedidoController::class, 'update']);

    Route::get('/usuario', [UsuarioController::class, 'index']);
    Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
    Route::post('/usuario', [UsuarioController::class, 'store']);
    Route::put('/usuario/{id}', [UsuarioController::class, 'update']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
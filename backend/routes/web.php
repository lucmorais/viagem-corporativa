<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\ApiMiddleware;

Route::get('/pedido', [PedidoController::class, 'index']);
Route::get('/usuario', [UsuarioController::class, 'index']);

Route::middleware(ApiMiddleware::class)->group(function () {
    Route::get('/pedido/{id}', [PedidoController::class, 'show']);
    Route::post('/pedido', [PedidoController::class, 'store']);
    Route::put('/pedido/{id}', [PedidoController::class, 'update']);

    Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
    Route::post('/usuario', [UsuarioController::class, 'store']);
    Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

// Rota para listar itens (com busca e paginação)
Route::get('/items', [ItemController::class, 'index']);

// Rota para adicionar um novo item
Route::post('/items', [ItemController::class, 'store']);
<?php

use Illuminate\Http\Request;
use App\Http\Controllers\NfeController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Apenas para definir o endpoint da API
Route::get('/nfe/{id}', [NfeController::class, 'show']);


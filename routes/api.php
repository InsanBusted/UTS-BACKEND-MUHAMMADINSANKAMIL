<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/news', [BeritaController::class, 'index']);
    Route::post('/news', [BeritaController::class, 'store']);
    Route::get('/news/{id}', [BeritaController::class, 'show']);
    Route::put('/news/{id}', [BeritaController::class, 'update']);
    Route::delete('/news/{id}', [BeritaController::class, 'destroy']);
    Route::get('/news/search/{title}', [BeritaController::class, 'search']);
    Route::get('/news/category/sport', [BeritaController::class, 'sport']);
    Route::get('/news/category/finance', [BeritaController::class, 'finance']);
    Route::get('/news/category/automotive', [BeritaController::class, 'automotive']);
});


Route::post('/news/register', [AuthController::class, 'register']); 
Route::post('/news/login', [AuthController::class, 'login']);
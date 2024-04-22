<?php

use App\Http\Controllers\{CarController, LoginController, OwnerController};
use App\Http\Middleware\JWTMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/owners', [OwnerController::class, 'create']);
Route::get('/owners', [OwnerController::class, 'retrieve']);
Route::get('/owners/{id}/', [OwnerController::class, 'retrieve']);
Route::patch('/owners/{id}/', [OwnerController::class, 'update'])->middleware(JWTMiddleware::class);
Route::delete('/owners/{id}/', [OwnerController::class, 'destroy'])->middleware(JWTMiddleware::class);


Route::get('/cars', [CarController::class, 'retrieve']);
Route::get('/cars/{id}/', [CarController::class, 'retrieve']);
Route::post('/cars', [CarController::class, 'create'])->middleware(JWTMiddleware::class);
Route::patch('/cars/{id}/', [CarController::class, 'update'])->middleware(JWTMiddleware::class);
Route::delete('/cars/{id}/', [CarController::class, 'destroy'])->middleware(JWTMiddleware::class);


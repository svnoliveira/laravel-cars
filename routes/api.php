<?php

use App\Http\Controllers\{LoginController, OwnerController};
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/owners', [OwnerController::class, 'create']);
Route::post('/auth/login', [LoginController::class, 'login']);

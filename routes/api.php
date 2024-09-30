<?php

use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\BookController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);

Route::apiResource('books', BookController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('authors', AuthorController::class);
});

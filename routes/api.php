<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\BookController;

Route::apiResource('books', BookController::class);
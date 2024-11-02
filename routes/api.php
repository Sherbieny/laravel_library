<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthController;

Route::post('/sanctum/token', [AuthController::class, 'createToken']);
Route::post('/sanctum/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books', [BookController::class, 'store'])->middleware('abilities:create-book');
    Route::get('/books/{id}', [BookController::class, 'show'])->middleware('abilities:view-book');
    Route::put('/books/{id}', [BookController::class, 'update'])->middleware('abilities:update-book');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('abilities:delete-book');
});

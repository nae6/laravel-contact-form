<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Contact Form
Route::get('/', [ContactController::class, 'index'])
    ->name('index');
Route::post('/confirm', [ContactController::class, 'confirm'])
    ->name('confirm');
Route::post('/thanks', [ContactController::class, 'store'])
    ->name('thanks');

// Register & Login
Route::get('/register', [AuthController::class, 'index']);

// Administrator
Route::get('/admin', [AdminController::class, 'index']);

Route::get('/todos/search', [TodoController::class, 'search'])
        ->name('todos.search');
Route::delete('/todos/{todo}', [CompleteController::class, 'destroy'])
        ->name('todos.delete');
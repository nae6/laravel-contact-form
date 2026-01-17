<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

// Contact Form
Route::get('/', [ContactController::class, 'index'])
    ->name('index');
Route::post('contacts/confirm', [ContactController::class, 'confirm'])
    ->name('confirm');
Route::post('contacts/thanks', [ContactController::class, 'store'])
    ->name('thanks');
Route::post('/contacts/back', [ContactController::class, 'back'])
    ->name('contacts.back');


// Administrator
Route::middleware('auth')->group(function ()
{
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');
    Route::get('/admin/search', [AdminController::class, 'search'])
        ->name('admin.search');
    Route::delete('/admin/{contact}', [AdminController::class, 'destroy'])
        ->name('admin.destroy');
});
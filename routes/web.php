<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticalController;
use App\Http\Controllers\FormController;


Route::view('/', 'welcome');

Route::get('articals', [ArticalController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('articals'); 

Route::get('forms', [FormController::class, 'index'])
->middleware(['auth', 'verified'])
->name('forms'); 

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

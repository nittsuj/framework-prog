<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/project-idea', [PageController::class, 'project'])->name('project');

// Tantangan 1: Kalkulator Dinamis
Route::get('/hitung', [PageController::class, 'calculator'])->name('calculator');
Route::get('/hitung/{angka1}/{angka2}/{operasi}', [PageController::class, 'hitung'])
    ->name('calculation');

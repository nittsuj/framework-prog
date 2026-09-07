<?php

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/project-idea', [PageController::class, 'project']);
Route::get('/hitung/{angka1}/{angka2}/{operasi}', [PageController::class, 'hitung'])
->where(['angka1' => '[0-9]+', 'angka2' => '[0-9]+']);


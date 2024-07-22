<?php

use App\Http\Controllers\PointController;
use Illuminate\Support\Facades\Route;


Route::post('/points', [PointController::class, 'store'])->name('points.store');
Route::get('/points', [PointController::class, 'index'])->name('points.index');

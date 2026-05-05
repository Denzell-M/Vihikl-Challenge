<?php

use App\Http\Controllers\OilChangeCheckController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OilChangeCheckController::class, 'create'])->name('oil-change-checks.create');
Route::post('/check', [OilChangeCheckController::class, 'store'])->name('oil-change-checks.store');
Route::get('/result/{oilChangeCheck}', [OilChangeCheckController::class, 'show'])->name('oil-change-checks.show');

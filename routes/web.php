<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentPlanController;

Route::get('/', [ContentPlanController::class, 'index']);
Route::post('/store', [ContentPlanController::class, 'store'])->name('store');
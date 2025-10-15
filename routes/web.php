<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LetterheadController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/', [LetterheadController::class, 'index']);
Route::post('/process', [LetterheadController::class, 'process'])->name('process');

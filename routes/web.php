<?php

use App\Http\Controllers\FromController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forms/{id}',[FromController::class,'show']);
Route::post('/forms/{id}',[FromController::class,'submit']);


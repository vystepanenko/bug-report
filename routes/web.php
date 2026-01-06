<?php

use App\Http\Controllers\TestModelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/model/{id}', [TestModelController::class, 'index']);

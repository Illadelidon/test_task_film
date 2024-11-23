<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/create-movie', function () {
    return view('test');
});
Route::post('/test-movie', [\App\Http\Controllers\MovieController::class, 'create']);

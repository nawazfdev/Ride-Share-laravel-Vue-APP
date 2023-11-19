<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\LoginController;
 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login/{phone}',[LoginController::class,'submit']);
Route::post('/login/verify',[LoginController::class,'verify']);

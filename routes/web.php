<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    return view('layout/index');
});

//Registro
Route::get('/register', [RegisterController::class, "ShowRegisterForm"])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [RegisterController::class, "Register"])
    ->middleware('guest');

//Login
Route::get('/login', [LoginController::class, "ShowLoginForm"])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [LoginController::class, "Login"])
    ->middleware('guest');

//Logout
Route::post('/logout', [LoginController::class, "Logout"])-> name('logout');

//Páginas protegidas
Route::get('/products', function(){
    return view('/products');
})->middleware('auth');
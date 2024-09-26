<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('users', UserController::class);

    Route::resource('countries', CountryController::class);
    Route::resource('cities', CityController::class);
    Route::resource('departments', DepartamentController::class);
    Route::get('/departments/{city_id}/city', [DepartamentController::class, 'getCities'])->name('departments.cities');
});


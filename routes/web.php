<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\EmployePositionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('users', UserController::class);
    Route::get('/users/{user}/bosses-by-id', [UserController::class, 'getBossesByUserId'])->name('users.getBossesByUserId');

    Route::resource('countries', CountryController::class);

    Route::resource('cities', CityController::class);

    Route::resource('departments', DepartamentController::class);
    Route::get('/departments/{city_id}/city', [DepartamentController::class, 'getCities'])->name('departments.cities');

    Route::resource('positions', PositionController::class);

    Route::post('/employeepositions', [EmployePositionController::class, 'store'])->name('employeepositions.store');
    Route::get('/employeepositions/{user}/available-positions', [EmployePositionController::class, 'getAvailablePositions']);

});


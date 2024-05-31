<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CountryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');});
Route::get('driver', [DriverController::class, 'driver']);
Route::delete('/driver/{id_driver}', [DriverController::class, 'delete']);
Route::get('/{name}/{id}/edit', [DriverController::class, 'edit']);
Route::put('/drivers/{id}', [DriverController::class, 'update']);
Route::get('/drivers/create', [DriverController::class, 'create']);
Route::post('/drivers', [DriverController::class, 'store']);
Route::delete('/country/delete/{id}', [CountryController::class, 'delete']);
Route::get('/country/create', [CountryController::class, 'create']);
Route::post('/country/add', [CountryController::class, 'save']);
Route::get('/country', [CountryController::class, 'country']);
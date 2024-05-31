<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CountryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/driver', [DriverController::class, 'driver']);
Route::delete('/driver/{id_driver}', [DriverController::class, 'delete']);
Route::get('/{name}/{id}/edit', [DriverController::class, 'edit']);
Route::put('/drivers/{id}', [DriverController::class, 'update']);
Route::get('/drivers/create', [DriverController::class, 'create']);
Route::post('/drivers', [DriverController::class, 'store']);
Route::delete('/country/delete/{id}', [CountryController::class, 'delete']);
Route::get('/country/create', [CountryController::class, 'create']);
Route::post('/country/add', [CountryController::class, 'save']);
Route::get('/country', [CountryController::class, 'country']);




require __DIR__.'/auth.php';

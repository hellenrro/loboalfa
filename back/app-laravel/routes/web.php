<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

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

Route::get('/list', AnimalController::class . '@index');
Route::post('/create', AnimalController::class . '@store');
Route::delete('/delete/{id}', AnimalController::class . '@destroy');
Route::put('/edit/{id}', AnimalController::class . '@edit');


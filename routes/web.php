<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

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

Route::get('/', [PersonController::class, 'index']);
Route::get('/people', [PersonController::class, 'getPeople'])->name('people.list');
Route::post('/people', [PersonController::class, 'store'])->name('people.store');
Route::get('/people/{id}', [PersonController::class, 'edit'])->name('people.edit');
Route::put('/people/{id}', [PersonController::class, 'update'])->name('people.update');
Route::delete('/people/{id}', [PersonController::class, 'destroy'])->name('people.destroy');

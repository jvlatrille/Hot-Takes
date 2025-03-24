<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SauceController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sauces', [SauceController::class, 'index'])->name('sauces.index');
Route::get('/sauces/create', [SauceController::class, 'create'])->name('sauces.create');
Route::post('/sauces', [SauceController::class, 'store'])->name('sauces.store');
Route::get('/sauces/{id}', [SauceController::class, 'show'])->name('sauces.show');
Route::get('/sauces/{id}/edit', [SauceController::class, 'edit'])->name('sauces.edit');
Route::put('/sauces/{id}', [SauceController::class, 'update'])->name('sauces.update');
Route::delete('/sauces/{id}', [SauceController::class, 'destroy'])->name('sauces.destroy');
Route::post('/sauces/{id}/like', [SauceController::class, 'like'])->name('sauces.like');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

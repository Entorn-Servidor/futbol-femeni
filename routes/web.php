<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;

Route::get('/', fn() => "Benvingut a la Guia d'Equips de Futbol Femení!");
Route::resource('equips', EquipController::class);
Route::prefix('estadis')->name('estadis.')->group(function () {
    Route::get('/', [EstadiController::class, 'index'])->name('index');
    Route::get('/crear', [EstadiController::class, 'create'])->name('create');
    Route::post('/', [EstadiController::class, 'store'])->name('store');
});
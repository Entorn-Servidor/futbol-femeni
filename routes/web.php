<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Importamos tus controladores nuevos
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('equips')->name('equips.')->group(function () {
    
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/crear', [EquipController::class, 'create'])->name('create');
        Route::post('/', [EquipController::class, 'store'])->name('store');
        Route::get('/{equip}/editar', [EquipController::class, 'edit'])->name('edit');
    });

    Route::get('/', [EquipController::class, 'index'])->name('index');
    Route::get('/{equip}', [EquipController::class, 'show'])->name('show');
});

Route::prefix('estadis')->name('estadis.')->group(function () {
    
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/crear', [EstadiController::class, 'create'])->name('create');
        Route::post('/', [EstadiController::class, 'store'])->name('store');
    });

    Route::get('/', [EstadiController::class, 'index'])->name('index');
    Route::get('/{estadi}', [EstadiController::class, 'show'])->name('show');
});

Route::prefix('jugadores')->name('jugadores.')->group(function () {
    Route::get('/', [JugadoraController::class, 'index'])->name('index');
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/crear', [JugadoraController::class, 'create'])->name('create');
        Route::post('/', [JugadoraController::class, 'store'])->name('store');
    });
});

Route::prefix('partits')->name('partits.')->group(function () {
    Route::get('/', [PartitController::class, 'index'])->name('index');
    Route::get('/crear', [PartitController::class, 'create'])->name('create'); // Ojo: proteger si quieres
    Route::post('/', [PartitController::class, 'store'])->name('store');
    Route::get('/{partit}', [PartitController::class, 'show'])->name('show');
});

Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__.'/auth.php';
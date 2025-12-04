<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Importamos tus controladores nuevos
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;

// --- RUTA HOME ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

// --- RUTA DASHBOARD (Por defecto de Laravel) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- RUTAS DE PERFIL (Por defecto de Laravel) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================================
// RUTES DEL PROYECTO (FÚTBOL FEMENINO)
// ==========================================================

// --- RUTES EQUIPS ---
Route::prefix('equips')->name('equips.')->group(function () {
    
    // 1. SOLO ADMINISTRADORES (Crear, Editar, Borrar)
    // Usamos 'auth' (logueado) Y 'role:admin' (tu middleware)
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/crear', [EquipController::class, 'create'])->name('create');
        Route::post('/', [EquipController::class, 'store'])->name('store');
        // Si tienes editar/borrar, irían aquí:
        Route::get('/{equip}/editar', [EquipController::class, 'edit'])->name('edit');
        // Route::put('/{equip}', [EquipController::class, 'update'])->name('update');
    });

    // 2. PÚBLICAS (Cualquiera puede ver el listado y detalle)
    Route::get('/', [EquipController::class, 'index'])->name('index');
    Route::get('/{equip}', [EquipController::class, 'show'])->name('show');
});

// --- RUTES ESTADIS ---
Route::prefix('estadis')->name('estadis.')->group(function () {
    
    // 1. SOLO ADMINISTRADORES
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/crear', [EstadiController::class, 'create'])->name('create');
        Route::post('/', [EstadiController::class, 'store'])->name('store');
    });

    // 2. PÚBLICAS
    Route::get('/', [EstadiController::class, 'index'])->name('index');
    Route::get('/{estadi}', [EstadiController::class, 'show'])->name('show');
});

// --- RUTES JUGADORES (Ejemplo básico) ---
Route::prefix('jugadores')->name('jugadores.')->group(function () {
    Route::get('/', [JugadoraController::class, 'index'])->name('index');
    // Si quieres proteger crear jugadores, mételo dentro de un middleware group como arriba
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/crear', [JugadoraController::class, 'create'])->name('create');
        Route::post('/', [JugadoraController::class, 'store'])->name('store');
    });
});

// --- RUTES PARTITS ---
Route::prefix('partits')->name('partits.')->group(function () {
    Route::get('/', [PartitController::class, 'index'])->name('index');
    Route::get('/crear', [PartitController::class, 'create'])->name('create'); // Ojo: proteger si quieres
    Route::post('/', [PartitController::class, 'store'])->name('store');
    Route::get('/{partit}', [PartitController::class, 'show'])->name('show');
});

// Carga las rutas de autenticación (login, register, etc.)
require __DIR__.'/auth.php';
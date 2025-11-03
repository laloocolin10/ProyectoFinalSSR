<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/**
 * ESTA ES LA RUTA QUE ARREGLA EL 404
 * La necesitamos para que Laravel sepa a dónde ir
 * después de un cierre de sesión.
 */
Route::get('/', function () {
    return view('welcome');
});

// Ruta del Dashboard (creada por Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas
Route::middleware('auth')->group(function () {
    // Rutas del Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Módulo 2: Rutas de Admin de Cursos
    Route::resource('courses', CourseController::class)->except(['show']);
});

// Importar rutas de autenticación (/login, /register, /logout, etc.)
require __DIR__.'/auth.php';
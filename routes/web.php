<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicCourseController; // Importamos el controlador público
use App\Http\Controllers\ReviewController;     // Importamos el controlador de reseñas

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde registramos todas las rutas.
|
*/

// --- RUTAS PÚBLICAS (MÓDULO 3) ---
// Esta es la ruta que te da 404. La estamos definiendo ahora:
Route::get('/', [PublicCourseController::class, 'index'])->name('home');

// Esta es la ruta para ver un curso específico:
Route::get('/curso/{course}', [PublicCourseController::class, 'show'])->name('courses.show');


// --- RUTAS PROTEGIDAS (PARA USUARIOS LOGUEADOS) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Módulo 2: Rutas de Admin de Cursos
    Route::resource('courses', CourseController::class)->except(['show']);
    
    // Módulo 4: Ruta para guardar reseñas
    Route::post('/curso/{course}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// --- RUTAS DE AUTENTICACIÓN ---
// Esto importa /login, /register, /logout, etc.
require __DIR__.'/auth.php';
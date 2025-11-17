<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// AÑADIMOS EL NUEVO CONTROLADOR PÚBLICO
use App\Http\Controllers\PublicCourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/**
 * RUTAS PÚBLICAS (Módulo 3)
 * Estas son las rutas que cualquiera puede ver, sin iniciar sesión.
 */
// CAMBIAMOS LA RUTA RAÍZ (/) para que use PublicCourseController [cite: 122-123]
Route::get('/', [PublicCourseController::class, 'index'])->name('home');

// AÑADIMOS la ruta para la vista de detalle (la usaremos en la Tarea 3) [cite: 125-126]
Route::get('/curso/{course}', [PublicCourseController::class, 'show'])->name('courses.show');


/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Dashboard y Admin)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas del Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Módulo 2: Rutas de Admin de Cursos
    Route::resource('courses', CourseController::class)->except(['show']);
});

// Importar rutas de autenticación (/login, /register, etc.)
require __DIR__.'/auth.php';
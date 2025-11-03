<?php
// ... al inicio de routes/web.php
use App\Http\Controllers\CourseController;

// ... (tus otras rutas)

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // AÑADE ESTA LÍNEA:
    // Esto crea las rutas para:
    // courses.index, courses.create, courses.store,
    // courses.edit, courses.update, courses.destroy
    // (Omitimos 'show' porque será público)
    Route::resource('courses', CourseController::class)->except(['show']);
});
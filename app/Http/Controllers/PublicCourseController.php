<?php

namespace App\Http\Controllers;

use App\Models\Course; // Importamos el modelo
use Illuminate\Http\Request;

class PublicCourseController extends Controller
{
    /**
     * Muestra la página de inicio (Práctica 3 - Ya completada)
     */
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('home', [
            'courses' => $courses,
        ]);
    }

    /**
     * Muestra la página de detalle de un curso (Tarea 3)
     */
    public function show(Course $course)
    {
        // ¡REQUISITO CRÍTICO DE TAREA 3! (Eager Loading)
        // Cargamos el curso CON ('with') sus 'reviews'
        // y también el 'user' de cada 'review' de una sola vez.
        // Esto previene el problema N+1.
        $course->load('reviews.user');

        // Renderizamos la vista de detalle y le pasamos el curso
        return view('courses.show', [
            'course' => $course,
        ]);
    }
}
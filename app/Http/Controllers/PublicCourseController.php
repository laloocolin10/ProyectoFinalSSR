<?php

namespace App\Http\Controllers;

use App\Models\Course; // <-- Importamos el modelo
use Illuminate\Http\Request;

class PublicCourseController extends Controller
{
    /**
     * Muestra la página de inicio (Práctica 3).
     * Muestra una lista paginada de todos los cursos.
     */
    public function index()
    {
        // Obtenemos los cursos, 10 por página, ordenados por el más nuevo
        $courses = Course::latest()->paginate(10);

        // Renderizamos la vista 'home' y le pasamos los cursos
        return view('home', [
            'courses' => $courses,
        ]);
    }

    /**
     * Muestra la página de detalle de un curso (Tarea 3).
     * (La dejaremos lista para el siguiente paso)
     */
    public function show(Course $course)
    {
        // (Lógica de Tarea 3 irá aquí)
        // Por ahora, solo para probar:
        // return $course; 
    }
}
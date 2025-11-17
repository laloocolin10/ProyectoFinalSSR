<?php

namespace App\Http\Controllers;

use App\Models\Course; // <-- Importamos Course
use App\Http\Requests\StoreReviewRequest; // <-- Importamos nuestro FormRequest
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Almacena una nueva reseña en la base de datos.
     */
    public function store(StoreReviewRequest $request, Course $course)
    {
        // El $request ya fue validado por StoreReviewRequest

        // Creamos la reseña usando la relación
        // Esto asigna automáticamente el 'course_id'
        $course->reviews()->create([
            'user_id' => auth()->id(), // Asignamos el ID del usuario logueado
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirigimos de vuelta a la página del curso
        return back()->with('status', '¡Gracias por tu reseña!');
    }
}
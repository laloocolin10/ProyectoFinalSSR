<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Solo permite si el usuario está logueado
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // La calificación es requerida, debe ser un número entre 1 y 5
            'rating' => 'required|integer|min:1|max:5',
            // El comentario es requerido
            'comment' => 'required|string|min:10',
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review; 

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'instructor',
    ];

    /**
     * Relación: Un Curso tiene muchas Reseñas.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Le dice a Laravel que use el 'slug' en lugar del 'id'
     * para buscar cursos en la URL (Route Model Binding).
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * NUEVO: Calcula el promedio de calificación.
     * Retorna 0 si no hay reseñas, o un número con 1 decimal (ej. 4.5).
     */
    public function averageRating()
    {
        if ($this->reviews()->count() === 0) {
            return 0;
        }
        return round($this->reviews()->avg('rating'), 1);
    }

    /**
     * NUEVO: Retorna el texto descriptivo basado en el promedio.
     */
    public function ratingText()
    {
        $average = $this->averageRating();

        if ($average == 0) {
            return 'Sin calificar';
        } elseif ($average < 3) {
            return 'Malo';
        } elseif ($average < 4.5) {
            return 'Recomendado';
        } else {
            return 'Muy Bueno';
        }
    }
}
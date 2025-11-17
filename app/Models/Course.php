<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ¡¡ESTA ES LA LÍNEA QUE ARREGLA EL ERROR!!
use App\Models\Review; 

class Course extends Model
{
    use HasFactory;

    // Esto le da permiso al CourseController para el CREADOR
    protected $fillable = [
        'title',
        'slug',
        'description',
        'instructor',
    ];

    /**
     * Relación: Un Curso tiene muchas Reseñas.
     * (Esto es lo que causaba el error)
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Le dice a Laravel que use el 'slug' en lugar del 'id'
     * en las rutas (Route Model Binding).
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
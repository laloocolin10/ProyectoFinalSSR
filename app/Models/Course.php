<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review; // 1. IMPORTANTE: Traer el modelo Review

class Course extends Model
{
    use HasFactory;
    /**
     * 2. ASIGNACIÓN MASIVA (Fillable)
     * Esto es CRÍTICO para que el método 'store' y 'update'
     * del CourseController funcionen. Le da permiso a Laravel
     * para rellenar estos campos usando Course::create().
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'instructor',
    ];

    /**
     * 3. RELACIÓN CON RESEÑAS (Requisito Tarea 1)
     * Define que un Curso "tiene muchas" reseñas.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * 4. USAR SLUG EN LA URL (Requisito Tarea 1 / PDF)
     * Le dice a Laravel que cuando use Route Model Binding,
     * debe buscar los cursos por el campo 'slug' en lugar del 'id'.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
<?php

namespace App\Models; // <-- ¿Está esto bien escrito?

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;   // ¿Están estos 'use'?
use App\Models\Course; // ¿Están estos 'use'?

class Review extends Model // <-- ¿Está "Review" con 'R' mayúscula?
{
    use HasFactory;

    /**
     * Propiedad para asignación masiva (la usaremos en la Práctica 4).
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'rating',
        'comment',
    ];

    /**
     * Una Reseña pertenece a un Usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Una Reseña pertenece a un Curso.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
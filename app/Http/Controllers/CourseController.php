<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest; // Importamos
use App\Http\Requests\UpdateCourseRequest; // Importamos
use Illuminate\Support\Str; // Para generar el 'slug'

class CourseController extends Controller
{
    // Muestra el "dashboard" de admin (Tarea 2)
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('courses.index', compact('courses'));
    }

    // Muestra el formulario de creación [cite: 93]
    public function create()
    {
        return view('courses.create');
    }

    // Almacena el nuevo curso
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']); // Creamos el slug
        
        // (Asegúrate de tener $fillable en tu modelo Course)
        Course::create($data);
        
        return redirect()->route('courses.index')->with('status', 'Curso creado exitosamente.');
    }

    // Muestra el formulario de edición [cite: 95]
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Actualiza el curso 
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']); // Actualiza el slug por si cambia el título
        
        $course->update($data);
        
        return redirect()->route('courses.index')->with('status', 'Curso actualizado exitosamente.');
    }

    // Elimina el curso [cite: 98]
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('status', 'Curso eliminado.');
    }
}
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // <-- ¡MUY IMPORTANTE!
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;   // <-- Importamos User
use App\Models\Course; // <-- Importamos Course

class ApplicationTest extends TestCase
{
    /**
     * Esta línea mágica limpia la base de datos
     * antes de CADA prueba, para que no se "ensucie".
     */
    use RefreshDatabase;

    /**
     * PRUEBA 1 (Pública) [cite: 265-266]
     * Comprueba que la página de inicio se carga correctamente.
     */
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200); // 200 = OK
    }

    /**
     * PRUEBA 2 (Pública) [cite: 270-271]
     * Comprueba que la página de detalle muestra el título del curso.
     */
    public function test_course_detail_page_displays_course_title(): void
    {
        // 1. Necesitamos un curso en la BD para poder visitarlo
        // Usamos la Factory que Laravel provee
        $course = Course::factory()->create([
            'title' => 'Curso de Prueba Específico',
            'slug' => 'curso-de-prueba-especifico',
            'description' => 'Desc...',
            'instructor' => 'Profe'
        ]);

        // 2. Visitamos la página de detalle de ese curso
        $response = $this->get('/curso/' . $course->slug);

        // 3. Comprobamos que la página cargó (200) y que ve el título
        $response->assertStatus(200);
        $response->assertSee($course->title);
    }

    /**
     * PRUEBA 3 (Seguridad) [cite: 274-275]
     * Comprueba que un invitado (no logueado) no puede ver la página de crear curso.
     */
    public function test_guest_cannot_access_create_course_page(): void
    {
        // 1. Intentamos ir a la página de admin para crear un curso
        $response = $this->get('/courses/create');

        // 2. Comprobamos que nos redirigió (302) a la página de login
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * PRUEBA 4 (Funcional) [cite: 277-278]
     * Comprueba que un usuario logueado SÍ puede crear un curso.
     */
    public function test_authenticated_user_can_create_a_course(): void
    {
        // 1. Creamos un usuario falso
        $user = User::factory()->create();

        // 2. Simula que este usuario ha iniciado sesión
        $this->actingAs($user);

        // 3. Los datos que enviaremos en el formulario
        $courseData = [
            'title' => 'Curso Creado por un Test',
            'description' => 'Esta es la descripción del test.',
            'instructor' => 'Dr. P.rueba',
        ];

        // 4. Enviamos una petición POST (simulando el formulario)
        $response = $this->post('/courses', $courseData);

        // 5. Comprobamos que nos redirigió al dashboard de cursos
        $response->assertRedirect(route('courses.index'));

        // 6. ¡Lo más importante!
        // Comprobamos que el curso SÍ existe en la base de datos.
        $this->assertDatabaseHas('courses', [
            'title' => 'Curso Creado por un Test'
        ]);
    }
}
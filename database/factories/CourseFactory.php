<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Importamos Str

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // "faker" (this->faker) es una librería que genera datos falsos
        $title = $this->faker->sentence(4); // Genera una frase de 4 palabras
        
        return [
            'title' => $title,
            'slug' => Str::slug($title), // Genera el slug a partir del título
            'description' => $this->faker->paragraph(10), // Un párrafo de 10 frases
            'instructor' => $this->faker->name(), // Un nombre falso (ej. "Dr. John Doe")
        ];
    }
}
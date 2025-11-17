<!-- Usamos el layout de "invitado" que no tiene dashboard -->
<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Cursos Disponibles</h2>

                    <!-- Contenedor de la cuadrícula de cursos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        <!-- 
                            Iteramos sobre los cursos que el controlador nos pasó.
                            Usamos @forelse para manejar el caso de que no haya cursos.
                        -->
                        @forelse ($courses as $course)
                            <div class="bg-gray-50 p-6 rounded-lg shadow-md border border-gray-200 flex flex-col justify-between">
                                <div>
                                    <!-- 
                                        Enlace a la vista de detalle (Tarea 3).
                                        Usamos la ruta 'courses.show' y le pasamos el curso (automáticamente usará el slug).
                                    -->
                                    <a href="{{ route('courses.show', $course) }}">
                                        <h3 class="text-xl font-bold text-gray-800 hover:text-indigo-600 transition duration-150 ease-in-out">
                                            {{ $course->title }}
                                        </h3>
                                    </a>
                                    <p class="text-sm text-gray-500 mt-2">Por: {{ $course->instructor }}</p>
                                    
                                    <p class="text-gray-700 mt-4">
                                        {{ Str::limit($course->description, 150) }} <!-- Mostramos un extracto -->
                                    </p>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('courses.show', $course) }}" class="text-indigo-500 hover:text-indigo-700 font-semibold">
                                        Ver detalles y reseñas &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <!-- Esto se muestra si no hay cursos en la base de datos -->
                            <p class="text-gray-500 col-span-3">No hay cursos disponibles en este momento.</p>
                        @endforelse
                    </div>

                    <!-- 
                        Paginación (Práctica 3)
                        Esto mostrará los enlaces "Siguiente" y "Anterior"
                    -->
                    <div class="mt-8">
                        {{ $courses->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
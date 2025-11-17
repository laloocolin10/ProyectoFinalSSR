<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- INICIO DEL MENSAJE DE BIENVENIDA PERSONALIZADO -->
                    <h3 class="text-2xl font-semibold">
                        ¡Bienvenido, {{ Auth::user()->name }}!
                    </h3>
                    <p class="mt-4 text-gray-700 dark:text-gray-300">
                        Has iniciado sesión en el panel de administración de la **Plataforma de Reseñas de Cursos**.
                    </p>
                    <p class="mt-2 text-gray-700 dark:text-gray-300">
                        Desde aquí, tienes control total sobre el contenido del sitio:
                    </p>

                    <div class="mt-6 flex flex-col md:flex-row gap-4">
                        <!-- Enlace para Administrar Cursos -->
                        <a href="{{ route('courses.index') }}" class="block p-6 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition duration-150 ease-in-out">
                            <h4 class="font-bold text-lg">Administrar Cursos</h4>
                            <p class="mt-1">Crear, editar o eliminar los cursos que se muestran en el sitio público.</p>
                        </a>

                        <!-- Enlace para Ver el Sitio -->
                        <a href="{{ route('home') }}" class="block p-6 bg-white dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-50 text-gray-900 rounded-lg shadow-md border dark:border-gray-600 transition duration-150 ease-in-out">
                            <h4 class="font-bold text-lg">Ver Sitio Público</h4>
                            <p class="mt-1">Ir a la portada para ver los cursos y dejar reseñas (como un usuario).</p>
                        </a>
                    </div>
                    <!-- FIN DEL MENSAJE DE BIENVENIDA -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
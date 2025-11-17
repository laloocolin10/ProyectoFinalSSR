<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts (Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            
            <!-- Barra de Navegación Pública Sencilla -->
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <a href="/">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                        </div>
                        <!-- Enlaces de Login/Register -->
                        <div class="flex items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Contenido de la Página -->
            <main>
                <div class="py-12">
                    <!-- Aquí está el max-w-7xl que arregla el ancho -->
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2 class="text-2xl font-semibold mb-6">Cursos Disponibles</h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    
                                    @forelse ($courses as $course)
                                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-600 flex flex-col justify-between">
                                            <div>
                                                <a href="{{ route('courses.show', $course) }}">
                                                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 hover:text-indigo-600 transition duration-150 ease-in-out">
                                                        {{ $course->title }}
                                                    </h3>
                                                </a>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Por: {{ $course->instructor }}</p>
                                                
                                                <p class="text-gray-700 dark:text-gray-300 mt-4">
                                                    {{ Str::limit($course->description, 150) }}
                                                </p>
                                            </div>
                                            <div class="mt-4">
                                                <a href="{{ route('courses.show', $course) }}" class="text-indigo-500 hover:text-indigo-700 font-semibold">
                                                    Ver detalles y reseñas &rarr;
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 dark:text-gray-400 col-span-3">No hay cursos disponibles en este momento.</p>
                                    @endforelse
                                </div>

                                <div class="mt-8">
                                    {{ $courses->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
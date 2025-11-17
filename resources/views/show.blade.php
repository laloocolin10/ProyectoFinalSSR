<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $course->title }} - {{ config('app.name', 'Laravel') }}</title>

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
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            
                            <!-- Detalles del Curso -->
                            <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700">
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $course->title }}
                                </h1>
                                <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">
                                    Un curso de: <span class="font-semibold">{{ $course->instructor }}</span>
                                </p>

                                <p class="text-gray-800 dark:text-gray-300 mt-6 text-base leading-relaxed">
                                    {!! nl2br(e($course->description)) !!}
                                </p>
                            </div>

                            <!-- Sección de Reseñas -->
                            <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                                <h2 class="text-2xl font-semibold mb-6">Reseñas de Usuarios</h2>

                                <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border dark:border-gray-600">
                                    @auth
                                        <!-- (Práctica 4) Aquí irá el formulario -->
                                        <p class="text-gray-700 dark:text-gray-300">¡Gracias por iniciar sesión! Deja tu reseña.</p>
                                    @endauth
                                    
                                    @guest
                                        <p class="text-gray-600 dark:text-gray-400">
                                            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Inicia sesión</a>
                                            o <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">regístrate</a>
                                            para dejar tu propia reseña.
                                        </p>
                                    @endguest
                                </div>

                                <!-- Lista de Reseñas Existentes -->
                                <div class="space-y-6">
                                    @forelse ($course->reviews as $review)
                                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm">
                                            <div class="flex items-center mb-2">
                                                <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $review->user->name }}</p>
                                                
                                                <span class="ml-auto flex items-center">
                                                    <span class="text-yellow-500 font-bold text-lg">{{ $review->rating }}</span>
                                                    <svg class="w-5 h-5 text-yellow-400 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.446a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.368-2.446a1 1 0 00-1.175 0l-3.368 2.446c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.07 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <p class="text-gray-600 dark:text-gray-400">{{ $review->comment }}</p>
                                            <p class="text-xs text-gray-400 mt-2">
                                                {{ $review->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 dark:text-gray-400">Todavía no hay reseñas para este curso. ¡Sé el primero!</p>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
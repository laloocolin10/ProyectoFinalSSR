<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nuevo Curso
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('courses.store') }}">
                        @csrf
                        
                        <!-- Título -->
                        <div>
                            <!-- CORREGIDO: Componente de etiqueta -->
                            <x-input-label for="title" value="Título" />
                            <!-- CORREGIDO: Componente de campo de texto -->
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Instructor -->
                        <div class="mt-4">
                            <!-- CORREGIDO: Componente de etiqueta -->
                            <x-input-label for="instructor" value="Instructor" />
                            <!-- CORREGIDO: Componente de campo de texto -->
                            <x-text-input id="instructor" class="block mt-1 w-full" type="text" name="instructor" :value="old('instructor')" required />
                            <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
                        </div>

                        <!-- Descripción (Textarea es HTML estándar, solo se estila) -->
                        <div class="mt-4">
                            <!-- CORREGIDO: Componente de etiqueta -->
                            <x-input-label for="description" value="Descripción" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="5">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <!-- CORREGIDO: Componente de botón (para el color) -->
                            <x-primary-button class="ml-4">
                                Guardar Curso
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Curso: {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form method="POST" action="{{ route('courses.update', $course) }}">
                        @csrf
                        @method('PUT') <div>
                            <x-label for="title" value="Título" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $course->title)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="instructor" value="Instructor" />
                            <x-input id="instructor" class="block mt-1 w-full" type="text" name="instructor" :value="old('instructor', $course->instructor)" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="description" value="Descripción" />
                            <textarea id="description" name="description" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $course->description) }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                Actualizar Curso
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
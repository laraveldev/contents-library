<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Genres
            </h2>

            @role('admin')
            <a href="{{ url('/generes/create') }}"
               class="inline-block px-5 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white text-sm font-semibold rounded-xl shadow-lg transition duration-300">
                ➕ Create New Genre
            </a>
            @endrole
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-500 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Genre Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($generes as $genere)
                            <div class="bg-gradient-to-tl from-teal-500 to-blue-500 border border-teal-600 shadow-xl rounded-2xl p-6 text-white transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                                <h3 class="text-xl font-semibold mb-3">{{ $genere->name }}</h3>
                                <a href="{{ url('/generes/' . $genere->id) }}"
                                   class="inline-block mt-4 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-md transition">
                                    👁 Show
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

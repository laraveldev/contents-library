<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Authors
            </h2>

            @role('admin')
            <a href="{{ url('/authors/create') }}"
               class="inline-block px-5 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white text-sm font-semibold rounded-xl shadow-lg transition duration-300">
                ➕ Create New Author
            </a>
            @endrole
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-500 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($authors as $author)
                            <div class="bg-gradient-to-tr from-indigo-800 via-purple-700 to-indigo-900 border border-indigo-700 shadow-xl rounded-2xl p-6 text-white transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                                <h3 class="text-lg font-bold mb-3">{{ $author->name }}</h3>
                                <a href="{{ url('/authors/' . $author->id) }}"
                                   class="inline-block mt-4 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg shadow-md transition">
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

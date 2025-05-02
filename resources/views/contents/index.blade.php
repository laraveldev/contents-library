<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ url('/authors/create') }}"
               class="inline-block mt-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded">
                Create new content
            </a>
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($contents as $content)
                            <div class="bg-gray-800 border border-gray-600 shadow-lg rounded-xl p-6 text-white transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                                <h3 class="text-lg font-semibold mb-2">{{ $content->title }}</h3>
                                <p class="text-sm mb-4">{{ $content->description }}</p>
                                <a href="{{ route('contents.show', $content->id) }}" class="inline-block mt-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded">
                                    Show
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        {{ __('All contents') }}
        
            {{-- <div class="p-6 bg-white rounded shadow">
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $message }}
                </h1>
            </div> --}}
        
        
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

                    <!-- Grid Layout for Contents -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($contents as $content)
                            <div class="bg-gray-800 border border-gray-600 shadow-lg rounded-xl p-6 text-white transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                                <h3 class="text-lg font-semibold mb-2">{{ $content->title }}</h3>
                                
                                <!-- Description with fixed height -->
                                <p class="text-sm mb-4 overflow-hidden" style="max-height: 100px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                    {{ $content->description }}
                                </p>

                                <!-- Show button -->
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

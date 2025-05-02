<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Content Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                
                <h1 class="text-3xl font-bold mb-4">{{ $content->title }}</h1>

                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    {{ $content->description }}
                </p>

                <div class="mb-6">
                    <a href="{{ $content->url }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline hover:text-blue-800 dark:hover:text-blue-300">
                        Visit Book Website
                    </a>
                </div>

                <div class="mb-6">
                    <h5 class="text-lg font-semibold mb-2">Author(s)</h5>
                    @forelse($content->authors as $author)
                        <span class="inline-block bg-blue-700 text-white text-sm font-medium px-3 py-1 rounded-full mr-2 mb-2">
                            {{ $author->name }}
                        </span>
                    @empty
                        <span class="text-sm text-gray-500">No authors found</span>
                    @endforelse
                </div>

                <div class="mb-6">
                    <h5 class="text-lg font-semibold mb-2">Category</h5>
                    @if($content->category)
                        <span class="inline-block bg-gray-700 text-white text-sm font-medium px-3 py-1 rounded-full">
                            {{ $content->category->name }}
                        </span>
                    @else
                        <span class="text-sm text-gray-500">No category assigned</span>
                    @endif
                </div>

                <div class="mb-6">
                    <h5 class="text-lg font-semibold mb-2">Genres</h5>
                    @forelse($content->generes as $genere)
                        <span class="inline-block bg-green-700 text-white text-sm font-medium px-3 py-1 rounded-full mr-2 mb-2">
                            {{ $genere->name }}
                        </span>
                    @empty
                        <span class="text-sm text-gray-500">No genres found</span>
                    @endforelse
                </div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <!-- Edit button (yellow) -->
                <a href="{{ route('contents.edit', $content->id) }}"
                  class="inline-block px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold rounded">
                         Edit
                </a>
 
                         <!-- Delete button (red) -->
                <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;">
                    @csrf
                     @method('DELETE')
                    <button type="submit"
                    onclick="return confirm('Are you sure you want to delete this item?')"
                      class="inline-block px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded">
                            Delete
                    </button>
                </form>
 
                </h2>
                

            </div>
        </div>
    </div>
</x-app-layout>

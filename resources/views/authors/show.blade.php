<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Author') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                
                <h1 class="text-3xl font-bold mb-4">{{ $author->name }}</h1>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <!-- Edit button (yellow) -->
                <a href="{{ route('authors.edit', $author->id) }}"
                  class="inline-block px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold rounded">
                         Edit
                </a>
            
                         <!-- Delete button (red) -->
                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
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

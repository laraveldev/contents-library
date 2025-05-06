<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Content Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

                <!-- Author, Category, Genres at the left side and Edit/Delete buttons at the right -->
                <div class="mb-6 flex flex-wrap gap-4 items-center justify-between">
                    <!-- Author(s) -->
                    <div>
                        <h5 class="text-sm font-semibold mb-1">Author(s)</h5>
                        @forelse($content->authors as $author)
                            <a href="{{ route('authors.show', $author->id) }}" class="bg-blue-700 text-white text-xs font-medium px-3 py-1 rounded-full mr-2 mb-2 hover:bg-blue-800">
                                {{ $author->name }}
                            </a>
                        @empty
                            <span class="bg-gray-500 text-white text-xs font-medium px-3 py-1 rounded-full mr-2 mb-2">
                                No authors found
                            </span>
                        @endforelse
                    </div>

                    <!-- Category -->
                    <div>
                        <h5 class="text-sm font-semibold mb-1">Category</h5>
                        @if($content->category)
                            <a href="{{ route('categories.show', $content->category->id) }}" class="bg-gray-700 text-white text-xs font-medium px-3 py-1 rounded-full mr-2 mb-2 hover:bg-gray-800">
                                {{ $content->category->name }}
                            </a>
                        @else
                            <span class="bg-gray-500 text-white text-xs font-medium px-3 py-1 rounded-full mr-2 mb-2">
                                No category assigned
                            </span>
                        @endif
                    </div>

                    <!-- Genres -->
                    <div>
                        <h5 class="text-sm font-semibold mb-1">Genres</h5>
                        @forelse($content->generes as $genere)
                            <a href="{{ route('generes.show', $genere->id) }}" class="bg-green-700 text-white text-xs font-medium px-3 py-1 rounded-full mr-2 mb-2 hover:bg-green-800">
                                {{ $genere->name }}
                            </a>
                        @empty
                            <span class="bg-gray-500 text-white text-xs font-medium px-3 py-1 rounded-full mr-2 mb-2">
                                No genres found
                            </span>
                        @endforelse
                    </div>

                    <!-- Edit and Delete buttons at the right -->
                    <div class="flex gap-4">
                        <!-- Edit button -->
                        <a href="{{ route('contents.edit', $content->id) }}"
                            class="inline-block px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold rounded">
                            Edit
                        </a>

                        <!-- Delete button -->
                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this item?')"
                                class="inline-block px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Content Title and Description -->
                <h1 class="text-3xl font-bold mb-4">{{ $content->title }}</h1>

                
                <p class="text-gray-700 dark:text-gray-300 mb-6 whitespace-pre-line break-words">
                    {{ $content->description }}
                </p>
                
                

                <div class="mb-6">
                    <a href="{{ $content->url }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline hover:text-blue-800 dark:hover:text-blue-300">
                        Visit  Website
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

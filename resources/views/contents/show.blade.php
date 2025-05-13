<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ url()->previous() }}" 
                class="inline-block px-4 py-2 bg-gradient-to-r from-blue-600 to-pink-600 hover:from-blue-700 hover:to-pink-700 text-white text-sm font-semibold rounded shadow">
                ← Back
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 shadow-xl sm:rounded-2xl p-8 text-gray-100">

                <!-- Metadata -->
                <div class="mb-8 flex flex-wrap gap-6 items-start justify-between">

                    <!-- Category -->
                    <div>
                        <h5 class="text-sm font-semibold mb-1 text-gray-300">Category</h5>
                        @if($content->category)
                            <a href="{{ route('categories.show', $content->category->id) }}"
                               class="bg-blue-700 hover:bg-blue-800 text-white text-xs font-medium px-3 py-1 rounded-full">
                                {{ $content->category->name }}
                            </a>
                        @else
                            <span class="bg-gray-600 text-white text-xs font-medium px-3 py-1 rounded-full">
                                No category
                            </span>
                        @endif
                    </div>

                    <!-- Genres -->
                    <div>
                        <h5 class="text-sm font-semibold mb-1 text-gray-300">Genres</h5>
                        @forelse($content->generes as $genere)
                            <a href="{{ route('generes.show', $genere->id) }}"
                               class="bg-green-700 hover:bg-green-800 text-white text-xs font-medium px-3 py-1 rounded-full mr-2 mb-2 inline-block">
                                {{ $genere->name }}
                            </a>
                        @empty
                            <span class="bg-gray-600 text-white text-xs font-medium px-3 py-1 rounded-full">
                                No genres
                            </span>
                        @endforelse
                    </div>

                    <!-- Authors -->
                    <div>
                        <h5 class="text-sm font-semibold mb-1 text-gray-300">Author(s)</h5>
                        @forelse($content->authors as $author)
                            <a href="{{ route('authors.show', $author->id) }}"
                               class="bg-purple-700 hover:bg-purple-800 text-white text-xs font-medium px-3 py-1 rounded-full mr-2 mb-2 inline-block">
                                {{ $author->name }}
                            </a>
                        @empty
                            <span class="bg-gray-600 text-white text-xs font-medium px-3 py-1 rounded-full">
                                No authors
                            </span>
                        @endforelse
                    </div>

                    <!-- Actions -->
                    @if(auth()->id() === $content->user_id || auth()->id() === 1)
                        <div class="flex gap-4 mt-2">
                            <a href="{{ route('contents.edit', $content->id) }}"
                               class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold rounded shadow">
                                ✏️ Edit
                            </a>

                            <form action="{{ route('contents.destroy', $content->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this item?')"
                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded shadow">
                                    🗑 Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-4xl font-extrabold mb-6 text-white">{{ $content->title }}</h1>

                <!-- Description -->
                <p class="text-base leading-relaxed text-gray-300 mb-8 whitespace-pre-line break-words">
                    {{ $content->description }}
                </p>

                <!-- External Link -->
                @if($content->url)
                    <div>
                        <a href="{{ $content->url }}" target="_blank"
                           class="inline-block text-blue-400 hover:text-blue-300 underline font-medium">
                            🌐 Visit Website
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

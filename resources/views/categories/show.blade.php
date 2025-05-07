<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

                {{-- HEADER: Nomi + tugmalar --}}
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
                    @role('admin')
                    <div class="flex space-x-2">
                        {{-- Edit --}}
                        <a href="{{ route('categories.edit', $category->id) }}"
                           class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold rounded">
                            Edit name
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this item?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded">
                                Delete this Category
                            </button>
                        </form>
                    </div>
                    @endrole
                </div>

                {{-- CONTENTLAR: 3 ustunli grid --}}
                @if($category->contents->count())
                    <h2 class="text-xl font-semibold mb-4">Ushbu kategoriyadagi contentlar:</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($category->contents as $content)
                            <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4 shadow transition duration-300 hover:shadow-xl hover:ring-2 hover:ring-indigo-400">
                                <h3 class="text-lg font-bold mb-2 text-gray-900 dark:text-white">{{ $content->title }}</h3>
                                <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line break-words mb-4">
                                    {{ Str::limit($content->description, 150) }}
                                </p>
                                <a href="{{ route('contents.show', $content->id) }}"
                                   class="inline-block mt-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded">
                                    Show
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Bu kategoriya uchun contentlar topilmadi.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

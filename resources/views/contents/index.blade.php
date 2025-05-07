<x-app-layout>
    <x-slot name="header">
        @role('admin')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            
            <a href="{{ route('create.contents') }}"
               class="inline-block mt-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded">
                Create new content
            </a>
            
        </h2>
        @endrole
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

                                <!-- Button Row -->
                                <div class="flex justify-between items-center mt-4">
                                    <!-- Show Button -->
                                    <a href="{{ route('contents.show', $content->id) }}"
                                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded">
                                        Show
                                    </a>

                                    <!-- Like/Dislike -->
                                    <div class="flex items-center space-x-4">
                                        <form onsubmit="event.preventDefault(); likeContent({{ $content->id }});" class="inline">
                                            <button type="submit" class="text-xl">
                                                👍 <span id="like-count-{{ $content->id }}" class="ml-1">{{ $content->like_count }}</span>
                                            </button>
                                        </form>
                                        <form onsubmit="event.preventDefault(); dislikeContent({{ $content->id }});" class="inline">
                                            <button type="submit" class="text-xl">
                                                👎 <span id="dislike-count-{{ $content->id }}" class="ml-1">{{ $content->dislike_count }}</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function likeContent(id) {
            fetch(`/contents/${id}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    const countSpan = document.getElementById(`like-count-${id}`);
                    countSpan.textContent = parseInt(countSpan.textContent) + 1;
                }
            });
        }

        function dislikeContent(id) {
            fetch(`/contents/${id}/dislike`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    const countSpan = document.getElementById(`dislike-count-${id}`);
                    countSpan.textContent = parseInt(countSpan.textContent) + 1;
                }
            });
        }
    </script>
    
</x-app-layout>

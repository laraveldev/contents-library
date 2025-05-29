<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                📚 All Contents
            </h2>
<!-- 
            @role('admin')
            <a href="{{ route('create.contents') }}"
               class="inline-block px-5 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white text-sm font-semibold rounded-xl shadow-lg transition duration-300">
                ➕ Create New Content
            </a>
            @endrole -->
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 px-4 py-3 rounded-xl bg-gradient-to-r from-green-100 to-green-200 text-green-800 font-medium shadow">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($contents as $content)
                        <div class="bg-gradient-to-tr from-purple-600 via-indigo-600 to-blue-600 shadow-xl rounded-2xl p-6 text-white transform transition duration-300 hover:scale-[1.03] hover:shadow-2xl">
                            <h3 class="text-xl font-bold mb-3 truncate">{{ $content->title }}</h3>
                
                            <p class="text-sm mb-4 opacity-90 overflow-hidden" style="max-height: 100px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                {{ $content->description }}
                            </p>
                
                            <div class="flex justify-between items-center mt-6">
                                <a href="{{ route('contents.show', $content->id) }}"
                                   class="px-4 py-2 bg-white text-indigo-700 hover:bg-gray-100 text-sm font-semibold rounded-lg shadow transition">
                                    Show
                                </a>
                
                                <div class="flex items-center space-x-4 text-lg">
                                    <form onsubmit="event.preventDefault(); likeContent({{ $content->id }});" class="inline">
                                        <button type="submit" class="hover:text-green-300 transition">
                                            👍 <span id="like-count-{{ $content->id }}" class="ml-1 text-base font-semibold">{{ $content->like_count }}</span>
                                        </button>
                                    </form>
                                    <form onsubmit="event.preventDefault(); dislikeContent({{ $content->id }});" class="inline">
                                        <button type="submit" class="hover:text-red-300 transition">
                                            👎 <span id="dislike-count-{{ $content->id }}" class="ml-1 text-base font-semibold">{{ $content->dislike_count }}</span>
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

<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8 text-white">

                @if (session('success'))
                    <div class="mb-4 text-sm text-green-500">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ url('contents/store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Title --}}
                    <div>
                        <label for="title" class="block text-sm font-medium">Title</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md shadow-sm text-white">
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium">Description</label>
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md shadow-sm text-white"></textarea>
                    </div>

                    {{-- URL --}}
                    <div>
                        <label for="url" class="block text-sm font-medium">URL</label>
                        <input type="text" id="url" name="url" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md shadow-sm text-white">
                    </div>

                    {{-- Category (bitta) --}}
                    <div>
                        <label for="category_id" class="block text-sm font-medium">Category</label>
                        <select name="category_id" id="category_id" required class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md text-white">
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    {{-- Authors (ko‘plik) --}}
                    <div>
                        <label class="block text-sm font-medium">Authors</label>
                        <div id="selectAuthors">
                            <div class="flex items-center gap-2 mt-1">
                                <select name="authors[]" class="bg-gray-700 border border-gray-600 text-white rounded-md w-full">
                                    <option value="0" selected>Select author</option>
                                    @foreach($authors as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="button" id="addAuthorButton" class="mt-2 px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded">+ Add Author</button>
                    </div>

                    {{-- Genres (ko‘plik) --}}
                    <div>
                        <label class="block text-sm font-medium">Genres</label>
                        <div id="selectGenres">
                            <div class="flex items-center gap-2 mt-1">
                                <select name="generes[]" class="bg-gray-700 border border-gray-600 text-white rounded-md w-full">
                                    <option value="0" selected>Select genre</option>
                                    @foreach($generes as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="button" id="addGenreButton" class="mt-2 px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded">+ Add Genre</button>
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Authors
            const addAuthorButton = document.getElementById('addAuthorButton');
            const selectAuthors = document.getElementById('selectAuthors');

            addAuthorButton.addEventListener('click', function () {
                const wrapper = document.createElement('div');
                wrapper.className = 'flex items-center gap-2 mt-2';

                const originalSelect = selectAuthors.querySelector('select');
                const newSelect = originalSelect.cloneNode(true);
                newSelect.value = '';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.innerText = '-';
                removeBtn.className = 'px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700';
                removeBtn.addEventListener('click', function () {
                    wrapper.remove();
                });

                wrapper.appendChild(newSelect);
                wrapper.appendChild(removeBtn);
                selectAuthors.appendChild(wrapper);
            });

            // Genres
            const addGenreButton = document.getElementById('addGenreButton');
            const selectGenres = document.getElementById('selectGenres');

            addGenreButton.addEventListener('click', function () {
                const wrapper = document.createElement('div');
                wrapper.className = 'flex items-center gap-2 mt-2';

                const originalSelect = selectGenres.querySelector('select');
                const newSelect = originalSelect.cloneNode(true);
                newSelect.value = '';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.innerText = '-';
                removeBtn.className = 'px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700';
                removeBtn.addEventListener('click', function () {
                    wrapper.remove();
                });

                wrapper.appendChild(newSelect);
                wrapper.appendChild(removeBtn);
                selectGenres.appendChild(wrapper);
            });
        });
    </script>
</x-app-layout>

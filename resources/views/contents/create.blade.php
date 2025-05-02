<x-app-layout>
    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-8">
                @if (session('success'))
                    <div class="mb-4 text-sm text-green-500">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ url('contents/store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-white">Title</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-md shadow-sm focus:ring focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-white">Description</label>
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-md shadow-sm focus:ring focus:ring-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="url" class="block text-sm font-medium text-white">URL</label>
                        <input type="text" id="url" name="url" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-md shadow-sm focus:ring focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-white">Category</label>
                        <select name="category_id" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-md">
                            <option value="0" selected>Select a category</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Authors (multiple select) -->
                    <div>
                        <label for="authors" class="block text-sm font-medium text-white">Author</label>
                        <select name="authors[]" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-md">
                            <option value="0" selected>Select author</option>
                            @foreach($authors as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    

                    <!-- Genres (multiple select) -->
                    
                    <div>
                        <label for="generes" class="block text-sm font-medium text-white">Genres</label>
                        <select name="generes[]" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-md">
                            <option value="0" selected>Select genre</option>
                            @foreach($generes as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md shadow-sm">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

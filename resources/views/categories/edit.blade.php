<x-app-layout>
    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-8">
                @if (session('success'))
                    <div class="mb-4 text-sm text-green-500">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-white">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-md shadow-sm">
                    </div>               
                    <!-- Submit -->
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

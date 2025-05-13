<x-app-layout>
    <x-slot name="header">
        @role('admin')
            @if(auth()->user()->id == 1)
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Create New Admin
                    </h2>
                    <a href="{{ route('admin.create') }}"
                       class="inline-block px-6 py-3 bg-gradient-to-r from-teal-500 to-blue-600 hover:from-teal-600 hover:to-blue-700 text-white text-sm font-semibold rounded-lg shadow-md transition duration-300">
                        ➕ Add Admin
                    </a>
                </div>
            @endif
        @endrole
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-red-600 font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl p-6">
                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400 border-b dark:border-gray-700">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    @if ($user->id === 1)
                                        <span class="text-red-500 font-semibold">Super Admin</span>
                                    @elseif ($user->hasRole('admin'))
                                        <span class="text-blue-500 font-semibold">Admin</span>
                                    @else
                                        User
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if ($user->id === 1)
                                        <span class="text-gray-400 italic">No action</span>
                                    @else
                                        <div class="flex gap-3">
                                            {{-- Admin berish yoki olib tashlash --}}
                                            @if (!$user->hasRole('admin'))
                                                <form method="POST" action="{{ route('users.makeAdmin', $user) }}">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                                                        Make Admin
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('users.removeAdmin', $user) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Remove admin role?')"
                                                            class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                                                        Remove Admin
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Foydalanuvchini o‘chirish (faqat super admin) --}}
                                            @if(auth()->user()->id == 1)
                                                <form method="POST" action="{{ route('users.destroy', $user) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Delete this user?')"
                                                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

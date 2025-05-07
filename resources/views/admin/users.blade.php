<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-red-600">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="border-b dark:border-gray-700">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->id === 1)
                                    <span class="text-red-500 font-semibold">Super Admin</span>
                                @elseif ($user->hasRole('admin'))
                                    Admin
                                @else
                                    User
                                @endif
                            </td>
                            <td>
                                @if ($user->id === 1)
                                    <span class="text-gray-400 italic">No action</span>
                                @elseif (!$user->hasRole('admin'))
                                    <form method="POST" action="{{ route('users.makeAdmin', $user) }}">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:underline">Make Admin</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('users.removeAdmin', $user) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline"
                                            onclick="return confirm('Are you sure you want to remove admin role?')">
                                            Remove Admin
                                        </button>
                                    </form>
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

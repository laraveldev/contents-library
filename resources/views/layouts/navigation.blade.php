@php
    $navLinks = [
        ['route' => 'dashboard', 'label' => 'Home', 'admin' => true],
        ['route' => 'contents', 'label' => 'Contents'],
        ['route' => 'authors', 'label' => 'Authors'],
        ['route' => 'generes', 'label' => 'Genres'],
        ['route' => 'categories', 'label' => 'Categories'],
        ['route' => 'users', 'label' => 'Users', 'admin' => true],
    ];
@endphp

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-3">
                <!-- Logo -->
                @role('admin')
                @if(auth()->user()->id == 1)
                    <div class="shrink-0">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>
                @endif
                @endrole

                <!-- Navigation Links -->
                @foreach ($navLinks as $link)
                    @if (empty($link['admin']) || (auth()->user()->hasRole('admin') && auth()->user()->id == 1))
                        @php
                            $isActive = request()->routeIs($link['route']);
                        @endphp
                        <a 
                            href="{{ route($link['route']) }}"
                            class="px-4 py-2 text-sm font-semibold rounded-xl transition duration-300
                                {{ $isActive 
                                    ? 'bg-white text-indigo-700 shadow-md border border-indigo-600 dark:bg-gray-800 dark:text-white' 
                                    : 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:from-indigo-500 hover:to-purple-500 hover:shadow-md border border-transparent' 
                                }}"
                        >
                            {{ __($link['label']) }}
                        </a>
                    @endif
                @endforeach
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 hover:text-gray-900 dark:hover:text-white focus:outline-none transition">
                            <div>@role('admin') Admin: @endrole {{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger for small screens -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($navLinks as $link)
                @if (empty($link['admin']) || (auth()->user()->hasRole('admin') && auth()->user()->id == 1))
                    <x-responsive-nav-link :href="route($link['route'])" :active="request()->routeIs($link['route'])">
                        {{ __($link['label']) }}
                    </x-responsive-nav-link>
                @endif
            @endforeach
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

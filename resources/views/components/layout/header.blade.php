@props([
    'title' => 'LaraTask',
])

<header class="fixed top-0 z-50 w-full bg-white/95 backdrop-blur-md shadow-sm border-b">
    <nav class="container mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Logo and Title -->
        <div class="flex items-center space-x-3">
            <a href="{{ url('/') }}" class="flex items-center">
                <!-- Replace with your actual logo SVG or image -->
                <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18l-6-6 6-6 1.4 1.4-4.6 4.6 4.6 4.6-1.4 1.4zM19 12h-7M12 6l-6 6 6 6 1.4-1.4-4.6-4.6 4.6-4.6-1.4-1.4z"/>
                </svg>
                <span class="ml-2 text-2xl font-bold text-gray-800">{{ config('app.name', 'LaraTask') }}</span>
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-6">
            @auth
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Login</a>
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Register</a>
            @endauth
        </div>

        <!-- Right Icons (Dark Mode Toggle, User Dropdown) -->
        <div class="hidden md:flex items-center space-x-4">
            <!-- Dark Mode Toggle -->
            <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <!-- Sun icon (visible in light mode) -->
                <svg id="theme-toggle-dark-icon" class="h-6 w-6 hidden text-gray-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707 8 8 0 1017.293 13.293z"></path>
                </svg>
                <!-- Moon icon (visible in dark mode) -->
                <svg id="theme-toggle-light-icon" class="h-6 w-6 hidden text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 18v1m-9-5h1m12 0h1M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M10 12h.01M10 16h.01M10 8h.01M16 10h.01"></path>
                </svg>
            </button>

            @auth
                <!-- User Avatar Dropdown -->
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = ! open" class="flex items-center space-x-1 focus:outline-none">
                        <!-- Placeholder for user avatar -->
                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center text-lg font-semibold text-gray-700">
                            {{ strtoupper(auth()->user()->initials ?? substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-10">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('password.reset') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Password</a>
                        <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            @csrf
                            <button type="submit" class="w-full text-left">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center">
            <button id="mobile-menu-button" class="focus:outline-none">
                <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Slide Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-md shadow-sm border-b">
        <div class="container mx-auto px-4 py-3">
            @auth
                <a href="{{ route('dashboard') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition duration-300">Dashboard</a>
                <!-- User Avatar Dropdown for Mobile -->
                <div class="relative mt-3" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = ! open" class="flex items-center space-x-1 focus:outline-none w-full justify-between">
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center text-lg font-semibold text-gray-700 mr-2">
                                {{ strtoupper(auth()->user()->initials ?? substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-gray-700">{{ auth()->user()->name ?? 'User' }}</span>
                        </div>
                        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="absolute left-0 mt-2 w-full bg-white rounded-md shadow-lg py-2 z-10">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('password.reset') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Password</a>
                        <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            @csrf
                            <button type="submit" class="w-full text-left">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition duration-300">Login</a>
                <a href="{{ route('register') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition duration-300">Register</a>
            @endauth
             <!-- Dark Mode Toggle for Mobile -->
            <div class="mt-3">
                <button id="theme-toggle-mobile" class="flex items-center p-2 rounded-full hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400 w-full justify-between">
                    <span class="text-gray-700">Dark Mode</span>
                    <svg id="theme-toggle-dark-icon-mobile" class="h-6 w-6 hidden text-gray-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707 8 8 0 1017.293 13.293z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon-mobile" class="h-6 w-6 hidden text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 18v1m-9-5h1m12 0h1M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M10 12h.01M10 16h.01M10 8h.01M16 10h.01"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>


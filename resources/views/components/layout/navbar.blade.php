<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">
                    LaraTask
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-900">Projects</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            Logout ({{ auth()->user()->username ?? auth()->user()->name }})
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

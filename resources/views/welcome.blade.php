<x-layout.app title="Welcome">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to LaraTask</h1>
            <p class="text-gray-600 mb-8">Manage your projects and tasks easily and effectively.</p>
            
            @auth
                <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    Go to Projects
                </a>
            @else
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</x-layout.app>
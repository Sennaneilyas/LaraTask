<x-layout.app title="My Profile">
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
            <div class="md:flex">
                <div class="md:flex-shrink-0 bg-blue-600 md:w-48 flex flex-col items-center justify-center p-8">
                    <div class="h-24 w-24 rounded-full bg-white flex items-center justify-center text-3xl font-bold text-blue-600 mb-4 shadow-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h2 class="text-white text-xl font-bold text-center">{{ $user->name }}</h2>
                    <p class="text-blue-100 text-sm capitalize">{{ $user->role }}</p>
                </div>
                <div class="p-8 w-full">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Profile Information</h3>
                            <p class="text-gray-500 dark:text-gray-400">Manage your account details</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Active Account
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Username</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->username }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email Address</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->email }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Phone</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->phone ?? 'Not provided' }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Member Since</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100 dark:border-gray-700 flex space-x-4">
                        <a href="{{ route('password.edit') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none transition-all">
                            Change Password
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none transition-all">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>

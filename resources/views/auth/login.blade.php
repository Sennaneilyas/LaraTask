<x-layout.app title="Login">
    <div class="max-w-md mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow-sm">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login to your account</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-forms.label for="email" value="Email Address" />
                <x-forms.input id="email" type="email" name="email" :value="old('email')" required autofocus />
                <x-forms.error :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div>
                <x-forms.label for="password" value="Password" />
                <x-forms.input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-forms.error :messages="$errors->get('password')" />
            </div>

            <div class="flex items-center justify-between">
                <a class="text-sm text-blue-600 hover:text-blue-900" href="{{ route('register') }}">
                    Don't have an account?
                </a>

                <x-forms.button>
                    Log in
                </x-forms.button>
            </div>
        </form>
    </div>
</x-layout.app>

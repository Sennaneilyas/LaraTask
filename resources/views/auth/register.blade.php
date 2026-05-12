<x-layout.app title="Register">
    <div class="max-w-md mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow-sm">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Create an account</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <x-forms.label for="name" value="Name" />
                <x-forms.input id="name" type="text" name="name" :value="old('name')" required autofocus />
                <x-forms.error :messages="$errors->get('name')" />
            </div>

            <!-- Username -->
            <div>
                <x-forms.label for="username" value="Username" />
                <x-forms.input id="username" type="text" name="username" :value="old('username')" required />
                <x-forms.error :messages="$errors->get('username')" />
            </div>

            <!-- Email Address -->
            <div>
                <x-forms.label for="email" value="Email Address" />
                <x-forms.input id="email" type="email" name="email" :value="old('email')" required />
                <x-forms.error :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div>
                <x-forms.label for="password" value="Password" />
                <x-forms.input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-forms.error :messages="$errors->get('password')" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-forms.label for="password_confirmation" value="Confirm Password" />
                <x-forms.input id="password_confirmation" type="password" name="password_confirmation" required />
                <x-forms.error :messages="$errors->get('password_confirmation')" />
            </div>

            <div class="flex items-center justify-between pt-4">
                <a class="text-sm text-blue-600 hover:text-blue-900" href="{{ route('login') }}">
                    Already registered?
                </a>

                <x-forms.button>
                    Register
                </x-forms.button>
            </div>
        </form>
    </div>
</x-layout.app>

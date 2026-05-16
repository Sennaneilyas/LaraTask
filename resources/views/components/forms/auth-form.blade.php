@props([
    'action',
    'method' => 'POST',
    'title',
    'subtitle', // Added for subtitle
    'submit' => 'Submit'
])

<div {{ $attributes->merge(['class' => 'max-w-md mx-auto mt-20 bg-white/80 backdrop-blur-xl shadow-2xl rounded-3xl p-8']) }}>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $title }}</h2>
        @if($subtitle)
            <p class="text-gray-600">{{ $subtitle }}</p>
        @endif
    </div>

    <form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" {{ $attributes->except(['class'])->merge(['class' => 'space-y-6']) }}>
        @csrf
        @if(!in_array($method, ['GET', 'POST']))
            @method($method)
        @endif


        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline"> Please check the following:</span>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Input Fields -->
        <div>
            {{ $fields }}
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-lg text-lg font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-300 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
                    x-bind:disabled="formIsSubmitting" {{-- Assuming Alpine.js or similar for loading state --}}
            >
                <span x-show="!formIsSubmitting">{{ $submit }}</span>
                <svg x-show="formIsSubmitting" class="animate-spin h-6 w-6 text-white mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 8l4-4.709z"></path>
                </svg>
            </button>
        </div>
    </form>
</div>
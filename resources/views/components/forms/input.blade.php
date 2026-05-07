@props([
    'label',
    'name',
    'type' => "text",
    'hint' => ""
])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }}
    </label>
    
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           {{ $attributes->merge([
               'class' => 'block w-full py-2 px-3 rounded-md shadow-sm ' . 
                          ($errors->has($name) 
                              ? 'border-red-300 dark:border-red-600 focus:ring-red-500 focus:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500' {{-- Error state --}}
                              : 'border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500' {{-- Default state --}}
                          ) . 
                          ' focus:outline-none focus:ring-2 focus:ring-offset-1 dark:ring-offset-gray-800' 
           ]) }}
    />

    @if ($hint)
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $hint }}</p>
    @endif
</div>

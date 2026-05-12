@props(['disabled' => false, 'type' => 'text'])

<input {{ $disabled ? 'disabled' : '' }} type="{{ $type }}" {!! $attributes->merge(['class' => 'w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border']) !!}>

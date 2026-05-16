@extends('layouts.app')

@section('title', 'Account Suspended')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] text-center">
    <div class="bg-red-100 p-6 rounded-full mb-6">
        <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Account Suspended</h1>
    <p class="text-lg text-gray-600 mb-8 max-w-md">
        Your account has been suspended. If you believe this is a mistake, please contact support.
    </p>
    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Back to Home
    </a>
</div>
@endsection

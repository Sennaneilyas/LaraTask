@extends('layouts.app', ['title' => 'Change Password'])
@section('content')
    <div class="max-w-2xl mx-auto p-8">
        <x-forms.auth-form :action="route('account.password')" method="PUT" title="Update Your Password"
            submit="Change Password">
            <x-slot name="fields">
                <div class="space-y-4">
                    <x-forms.input label="Current Password" name="current_password" type="password" />
                    <x-forms.input label="New Password" name="new_password" type="password"
                        hint="12+ chars, upper/lower/number/symbol" />
                    <x-forms.input label="Confirm Password" name="new_password_confirmation" type="password" />
                </div>
            </x-slot>
        </x-forms.auth-form>
    </div>
@endsection
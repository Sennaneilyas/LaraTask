<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', Password::defaults()
                    ->min(12)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(1, '2024-05-01'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'new_password.required' => 'The new password is required',
            'new_password.confirmed' => 'The password confirmation does not match.',
            'new_password.password' => 'Password must be at least 12 characters and include uppercase, lowercase, number, and symbol.'
        ]
    }
}

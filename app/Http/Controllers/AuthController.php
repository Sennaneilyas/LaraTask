<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;




class AuthController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Provided password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('success', 'Password changed successfully');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'], //While User model has: 'password' => 'hashed' in casts.
        ]);

        Auth::login($user, true); //second login parameter is true by default - remember? true

        return redirect()->route('projects.index')->with('success', "Welcome in our space . $user");
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        // Use Auth::attempt - it handles hashing, sessions, and security automatically.
        // The second parameter 'true' enables the "remember me" cookie.
        if (!Auth::attempt($credentials, true)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }
        // 3. Regenerate session to prevent "Session Fixation" attacks
        $request->session()->regenerate();
        return redirect()->route('projects.index')
            ->with('success', "Welcome back, " . auth()->user()->name);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out');
    }
}

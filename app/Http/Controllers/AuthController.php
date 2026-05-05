<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        if(!Hash::check($request->current_password, $user->password))
        {
            return back()->withErrors(['current_password' => 'Provided password does not match our records.']);
        }
        
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('success', 'Password changed successfully');
    }
}

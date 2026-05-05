<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('account.profile', compact('user'));
    }

    public function passwordChange()
    {
        return view('account.password-change');
    }
}

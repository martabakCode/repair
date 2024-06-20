<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'id_user' => 'required|string',
            'password' => 'required|string',
        ]);

        // Get the form data
        $credentials = $request->only('id_user', 'password');

        // Attempt to log the user in
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Authentication passed, redirect to intended page
            return redirect()->intended('home');
        }

        // Authentication failed, redirect back with error
        return redirect()->back()->withErrors(['msg' => 'Invalid credentials'])->withInput($request->except('password'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

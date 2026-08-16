<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$loginType => $request->login, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('user.dashboard'))->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'phone' => ['required', 'unique:users,phone', 'regex:/^(?:\+?88)?01[3-9][0-9]{8}$/'],
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Account registered successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}

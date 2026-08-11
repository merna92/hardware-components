<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display registration view.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $names = explode(' ', trim($validated['name']), 2);

        $user = User::create([
            'first_name'   => strip_tags($names[0]),
            'last_name'    => strip_tags($names[1] ?? ''),
            'name'         => strip_tags($validated['name']),
            'email'        => strtolower($validated['email']),
            'phone'        => $validated['phone'] ?? null,
            'phone_number' => $validated['phone'] ?? null,
            'password'     => Hash::make($validated['password']),
            'role'         => 'customer',
            'role_type'    => 'Customer',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('welcome')->with('success', 'Registration successful! Welcome to Hardware Components.')->with('showWelcome', true);
    }

    /**
     * Display login view.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle user authentication with rate limiting protection.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $throttleKey = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ])->onlyInput('email');
        }

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/admin/dashboard')->with('success', 'Welcome to Admin Dashboard.');
            }

            return redirect()->intended('/')->with('success', 'Logged in successfully.');
        }

        RateLimiter::hit($throttleKey);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}

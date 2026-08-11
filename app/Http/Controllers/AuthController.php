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
        // Data is pre-validated by RegisterRequest
        $validated = $request->validated();

        // Create new user with hashed password and forced 'customer' role
       // Extract first name and assign remaining full name to last name
        $names = explode(' ', trim($validated['name']), 2);

        $user = User::create([
            'first_name' => strip_tags($names[0]),
            'last_name'  => strip_tags($names[1] ?? ''),
            'name'       => strip_tags($validated['name']), // Store the full name as entered
            'email'      => strtolower($validated['email']),
            'phone'      => $validated['phone'],
            'password'   => Hash::make($validated['password']),
            'role'       => 'customer',
        ]);

        // Regenerate session immediately to prevent session fixation
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect to homepage with welcome modal flash trigger
        return redirect('/')->with('show_welcome_modal', true);
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
        // Throttle authentication attempts (Max 5 attempts per minute)
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
            // Clear rate limiter upon successful authentication
            RateLimiter::clear($throttleKey);

            // Prevent session fixation attack
            $request->session()->regenerate();

            // Role-based smart redirect
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard')->with('success', 'Welcome to Admin Dashboard.');
            }

            return redirect()->intended('/')->with('success', 'Logged in successfully.');
        }

        // Increment failed attempts count
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

        // Flush and invalidate session tokens
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
    
}
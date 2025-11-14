<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        Log::info('Login attempt started', ['email' => $request->email]);

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        Log::info('Credentials validated', ['email' => $credentials['email']]);

        if (Auth::attempt($credentials)) {
            Log::info('Auth attempt success', ['email' => $credentials['email']]);

            // Check if user is admin
            if (Auth::user()->role === 'admin') {
                Log::info('User is admin', ['user_id' => Auth::id()]);
                $request->session()->regenerate();
                return redirect()->intended(route('private.chat.users'));
            } else {
                Log::warning('User is not admin', [
                    'user_id' => Auth::id(),
                    'role' => Auth::user()->role,
                ]);

                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have admin privileges.',
                ])->onlyInput('email');
            }
        }

        Log::error('Auth attempt failed', ['email' => $credentials['email']]);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }
}
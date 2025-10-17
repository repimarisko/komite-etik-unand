<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Simple hardcoded login - only admin@admin.com with password 'admin'
        if ($request->login === 'admin@admin.com' && $request->password === 'admin') {
            $request->session()->regenerate();
            
            // Create a simple session to indicate logged in
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_email', 'admin@admin.com');
            
            return redirect()->intended(route('dashboard'));
        }

        throw ValidationException::withMessages([
            'login' => 'Email atau password salah. Gunakan admin@admin.com dengan password admin.',
        ]);
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        // Remove admin session
        $request->session()->forget('admin_logged_in');
        $request->session()->forget('admin_email');
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
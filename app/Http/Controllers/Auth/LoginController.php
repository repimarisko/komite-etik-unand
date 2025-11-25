<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        /** @var \App\Models\User|null $user */
        $user = User::where($loginField, $credentials['login'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'login' => 'Email/username atau password tidak sesuai.',
            ]);
        }

        if (!$user->isActive()) {
            throw ValidationException::withMessages([
                'login' => 'Akun Anda belum aktif atau dinonaktifkan.',
            ]);
        }

        if (!Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => 'Email/username atau password tidak sesuai.',
            ]);
        }

        $request->session()->regenerate();
        $request->session()->put('admin_logged_in', true);

        $user->updateLastLogin($request->ip());

        AdminActivityLog::logActivity(
            $user->id,
            'login',
            'App\\Models\\User',
            $user->id,
            null,
            null,
            'Login ke sistem',
            $request->ip(),
            $request->userAgent()
        );

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            AdminActivityLog::logActivity(
                Auth::id(),
                'logout',
                'App\\Models\\User',
                Auth::id(),
                null,
                null,
                'Logout dari sistem',
                $request->ip(),
                $request->userAgent()
            );
        }

        Auth::logout();

        $request->session()->forget('admin_logged_in');
        $request->session()->forget('admin_email');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}

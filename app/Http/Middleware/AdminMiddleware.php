<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use App\Models\AdminActivityLog;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): ResponseAlias
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();

        // Check if user is active
        if (!$user->isActive()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda telah dinonaktifkan.');
        }

        // Check if user has administrative roles
        if (!$user->hasAnyRole(['super_admin', 'verifikator', 'operator'])) {
            abort(403, 'Akses ditolak. Anda tidak memiliki hak untuk mengakses halaman ini.');
        }

        // Log admin access
        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('patch') || $request->isMethod('delete')) {
            AdminActivityLog::logActivity(
                $user->id,
                'access',
                'AdminPanel',
                null,
                null,
                null,
                'Mengakses halaman admin: ' . $request->path(),
                $request->ip(),
                $request->userAgent()
            );
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        if (!auth()->guard()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = auth()->guard()->user();

        // Check if user is active
        if (!$user->is_active) {
            auth()->guard()->logout();
            return redirect()->route('login')->with('error', 'Akun Anda telah dinonaktifkan.');
        }

        // Check if user is admin
        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
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
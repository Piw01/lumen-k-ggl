<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Cek apakah role user saat ini ada di dalam array $roles yang diizinkan
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Akses Ditolak: Akun Anda tidak memiliki izin mengakses halaman Command Center.');
        }

        return $next($request);
    }
}
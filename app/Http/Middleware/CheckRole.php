<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login'); 
        }

        $roles = explode('|', $role); 
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }
        return $next($request);
    }
}
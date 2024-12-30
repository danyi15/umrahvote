<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if (auth()->user()->type == $userType) {
            return $next($request);
        }

        // Mengembalikan tampilan error dengan pesan
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf, Anda Tidak Memilik Akses Kehalaman Ini.',
                'code' => 403
            ], 403);
        }

        // Jika bukan request JSON, alihkan pengguna ke halaman error
        return redirect()->route('errorPage')->with('error_message', 'Anda Tidak Memilik Akses Kehalaman Ini.');
    }
}

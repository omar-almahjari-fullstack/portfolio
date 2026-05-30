<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'يرجى تسجيل الدخول أولاً'], 401);
            }
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if user is admin - use loose comparison to handle both int and string values
        $isAdmin = ($user->is_admin ?? 0) == 1;
        
        if (!$isAdmin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'غير مصرح لك بالوصول'], 403);
            }
            abort(403, 'غير مصرح لك بالوصول');
        }

        return $next($request);
    }
}

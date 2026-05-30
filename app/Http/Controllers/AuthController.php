<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = DB::table('users')->where('email', $request->input('email'))->first();

            if (!$user) {
                return response()->json(['message' => 'البريد الإلكتروني غير مسجل'], 422);
            }

            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json(['message' => 'كلمة المرور خاطئة'], 422);
            }

            Auth::loginUsingId($user->id);

            $isAdmin = ($user->is_admin ?? 0) == 1;
            
            return response()->json([
                'message' => 'تم تسجيل الدخول بنجاح',
                'redirect' => $isAdmin ? route('dashboard') : route('home')
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'حدث خطأ: ' . $e->getMessage()], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ], [
                'email.unique' => 'هذا البريد الإلكتروني مسجل مسبقاً',
                'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
            ]);

            $id = DB::table('users')->insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Auth::loginUsingId($id);

            return response()->json([
                'message' => 'تم إنشاء الحساب بنجاح',
                'redirect' => route('home')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            $firstError = collect($errors)->flatten()->first();
            return response()->json(['message' => $firstError], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'حدث خطأ: ' . $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function checkAuth()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return response()->json([
                'authenticated' => true,
                'user' => [
                    'id' => Auth::id(),
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_admin' => ($user->is_admin ?? 0) == 1,
                ]
            ]);
        }
        
        return response()->json([
            'authenticated' => false
        ]);
    }
}

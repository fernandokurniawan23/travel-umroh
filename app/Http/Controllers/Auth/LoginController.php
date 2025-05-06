<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Method redirect setelah login, fallback
    protected function redirectTo()
    {
        return '/';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('url.intended');

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        // Cek apakah email sudah diverifikasi
        if (! $user->hasVerifiedEmail()) {
            auth()->logout();
            return redirect()->route('verification.notice')
                ->with('error', 'Silakan verifikasi email Anda terlebih dahulu.');
        }

        // Redirect berdasarkan role
        switch ($user->role) {
            case 'administrator':
                return redirect('/admin/dashboard');
            case 'ketua':
                return redirect('/admin/dashboard');
            case 'sekretaris':
                return redirect('/admin/dashboard');
            case 'bendahara':
                return redirect('/admin/dashboard');
            case 'administrasi':
                return redirect('/admin/dashboard');
            default:
                return redirect('/home'); // fallback umum
        }
    }
}

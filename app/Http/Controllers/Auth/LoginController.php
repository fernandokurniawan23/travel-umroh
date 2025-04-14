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

    protected function redirectTo()
    {
        if (auth()->user()->is_admin) {
            return '/admin/dashboard';
        }

        return '/';
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // Cek jika email belum terverifikasi
        if (!$user->hasVerifiedEmail()) {
            auth()->logout(); // Logout user
            return redirect()->route('login')->with('error', 'Anda harus memverifikasi email Anda sebelum dapat login.');
        }

        return redirect()->intended($this->redirectPath());
    }
}

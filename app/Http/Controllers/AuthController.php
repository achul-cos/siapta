<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        // Ambil semua guard dari config/auth.php
        $guards = array_keys(Config::get('auth.guards'));

        // Cari guard yang sedang aktif
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        // Bersihkan session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login umum
        return redirect('/');
    }
}

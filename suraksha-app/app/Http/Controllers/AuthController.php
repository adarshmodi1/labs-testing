<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show() { return view('auth.login'); }

    public function login(Request $r)
    {
        $cred = $r->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::guard('web')->attempt($cred + ['can_login' => true, 'is_active' => true], $r->boolean('remember'))) {
            $r->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors(['email' => 'Those details don’t match an active login.'])->onlyInput('email');
    }

    public function logout(Request $r)
    {
        Auth::guard('web')->logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('login');
    }
}

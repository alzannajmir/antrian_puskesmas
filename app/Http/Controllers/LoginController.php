<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('/auth/login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
    
            if ($user->is_admin) {
                return redirect()->intended('/dashboard');
            } elseif ($user->is_dokter) {
                return redirect()->intended('/dashboard-dokter');
            }
        }
    
        return back()->with('loginError', 'Login tidak berhasil!');
    }
    

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

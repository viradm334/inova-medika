<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            if($request->user()->role === 'Admin'){
                return redirect()->intended('/dashboard');
            }else if($request->user()->role === 'Petugas Pendaftaran'){
                return redirect()->intended('/pendaftaran');
            }else if($request->user()->role === 'Dokter'){
                return redirect()->intended('/dokter');
            }else if($request->user()->role === 'Kasir'){
                return redirect()->intended('/kasir');
            }
        };

        return back()->with('loginError', 'Email atau password salah!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

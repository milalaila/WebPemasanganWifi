<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\PaketWifi;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    // Menampilkan form registrasi
    public function form()
    {
        $provinsis = Provinsi::all();  // Ambil semua provinsi
        $paketWifi = PaketWifi::all();  // Ambil semua paket WiFi

        return view('registrasi', compact('provinsis', 'paketWifi'));
    }

    public function index() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.'
        ]);

        $infologin = $request->only('email', 'password');

        if(Auth::attempt($infologin)){
            $role = Auth::user()->role;
        
            switch($role) {
                case 'admin':
                    return redirect('/admin')->with('success', 'Anda Berhasil Login ke Admin');
                case 'pelanggan':
                    return redirect('/pelanggan')->with('success', 'Anda Berhasil Login ke Pelanggan');
                default:
                    Auth::logout();
                    return redirect()->back()->withErrors('Role tidak ditemukan.');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau Password yang Anda masukkan salah.');
        }
    }

    
    function logout(){
        Auth::logout();
        return redirect('/login');
    }
}

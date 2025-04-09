<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }
    function login(Request $request){
        $request->validate([
          'email'=>'required',
          'password'=>'required'
        ],[
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);
        
        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if (Auth::attempt($infologin)) {
            $user = Auth::user(); // Ambil user yang sudah login
        
            if ($user && $user->role == 'admin') {
                return redirect('/admin');
            } elseif ($user && $user->role == 'pelanggan') {
                return redirect('/pelanggan');
            }
        }
        else
        {
            return redirect('')->withErrors('Username dan password yang dimasukan tidak sesuai')->withInput();
        }
    }
    function logout(){
        Auth::logout();
        return redirect('');
    }
}

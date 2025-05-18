<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
   {

    function admin()
    {
      return view('dashboard.admin');
    }
    function pelanggan()
    {
      return view('dashboard.pelanggan');
    }
   }
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek role user yang sedang login
        $role = $user->role;

        return view('backend.website.home', compact('role'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Menampilkan halaman profil pengguna
    public function show()
    {
        return view('profile.show');
    }
}


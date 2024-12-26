<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua pengguna dan informasi apakah sudah memilih atau belum
        $users = User::with('vote')->get();

        return view('admin.users.index', compact('users'));

        // Ambil semua user kecuali admin
    $users = User::where('role', '!=', 'admin')->get();

    return view('manajemen_pengguna', compact('users'));
    }
}

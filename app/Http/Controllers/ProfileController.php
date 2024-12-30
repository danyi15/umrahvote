<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    // Menampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user')); // Mengarahkan ke halaman edit
    }

    // Update data profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'NIK' => 'required|string|max:16|unique:users,nik,' . $user->id,
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->NIK = $request->NIK;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->save(); // Simpan perubahan

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password berhasil diperbarui!');
    }
}

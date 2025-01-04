<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua pengguna dengan pagination, 10 per halaman
        $users = User::with('vote')->where('role', '!=', 'admin')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        // Pastikan hanya pengguna yang bukan admin yang bisa dihapus
        if ($user->role !== 'admin') {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
        }

        // Jika mencoba menghapus admin, beri respons error
        return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus pengguna admin.');
    }

    // Tambahkan metode edit untuk menampilkan formulir pengeditan
    public function edit(User $user)
    {
        // Menampilkan halaman pengeditan dengan membawa data pengguna
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi data input pengguna
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'NIK' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Perbarui data pengguna
        $user->update($validated);

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function showKandidat()
    {
        // Cek apakah profil pengguna sudah lengkap
        $user = Auth::user(); // Ambil pengguna yang sedang login

        // Periksa apakah profil pengguna lengkap dengan memeriksa nilai default
        if ($user->address === 'Unknown Address' ||
            $user->phone_number === '0000000000' ||
            $user->NIK === 0 ||
            empty($user->name)) {
            // Jika profil belum lengkap, arahkan ke halaman edit profil
            return redirect()->route('profile.edit')->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        // Jika sudah lengkap, tampilkan halaman untuk memilih kandidat
        return view('voter.showpilihan');
    }
}

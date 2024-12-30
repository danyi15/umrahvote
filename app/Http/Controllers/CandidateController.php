<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Support\Facades\Log;  // Menambahkan import Log facade
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function show($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('voter.showdetail', compact('candidate'));
    }

    public function dashboard()
    {
        $candidates = Candidate::withCount('votes')->get();

        return view('dashboard', compact('candidates'));
    }

   // Fungsi untuk menampilkan daftar kandidat bagi voter
   public function showPilihan()
   {
       // Ambil data semua kandidat
       $candidates = Candidate::all();

       // Kirim data kandidat ke view
       return view('voter.showpilihan', compact('candidates'));
   }

   // Fungsi untuk menampilkan daftar kandidat di admin
   public function index()
   {
       // Ambil semua data kandidat dari database
       $candidates = Candidate::orderBy('id_candidate')->get();

       // Kirim data kandidat ke view
       return view('admin.candidate.index', compact('candidates'));

   }

   // Fungsi untuk menampilkan form create
   public function create()
   {
       return view('admin.candidate.create');
   }

   // Fungsi untuk menyimpan kandidat ke database
   public function store(Request $request)
   {
       // Validasi input
       $validated = $request->validate([
           'nama_ketua' => 'required|string|max:255',
           'nama_wakil' => 'nullable|string|max:255', // opsional
           'visi' => 'required|string',
           'misi' => 'required|string',
           'program_kerja' => 'required|string',
           'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi foto
       ]);

       // Menyimpan foto jika ada
       $photoPath = $request->hasFile('photo')
           ? $request->file('photo')->store('candidate_photos', 'public')
           : null;

       // Simpan kandidat ke database
       Candidate::create([
           'nama_ketua' => $validated['nama_ketua'],
           'nama_wakil' => $validated['nama_wakil'] ?? null,
           'visi' => $validated['visi'],
           'misi' => $validated['misi'],
           'program_kerja' => $validated['program_kerja'],
           'photo' => $photoPath,
       ]);

       // Redirect dengan pesan sukses
       return redirect()->route('admin.candidate.index')->with('status', 'Kandidat berhasil ditambahkan!');
   }

   // Fungsi untuk menampilkan form edit kandidat
   public function edit($id_candidate)
   {
       try {
           // Logika untuk mengambil kandidat berdasarkan id_candidate
           $candidate = Candidate::findOrFail($id_candidate);

           // Menampilkan form edit kandidat
           return view('admin.candidate.edit', compact('candidate'));
       } catch (ModelNotFoundException $e) {
           return redirect()->route('admin.candidate.index')->with('error', 'Kandidat tidak ditemukan.');
       }
   }

   // Fungsi untuk memperbarui data kandidat
   public function update(Request $request, $id_candidate)
   {
       // Validasi input
       $validated = $request->validate([
           'nama_ketua' => 'required|string|max:255',
           'nama_wakil' => 'nullable|string|max:255',
           'visi' => 'required|string',
           'misi' => 'required|string',
           'program_kerja' => 'required|string',
           'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi foto
       ]);

       // Mencari kandidat berdasarkan id_candidate
       $candidate = Candidate::findOrFail($id_candidate);

       // Menyimpan foto jika ada
       if ($request->hasFile('photo')) {
           // Hapus foto lama jika ada
           if ($candidate->photo) {
               Storage::delete('public/' . $candidate->photo);
           }
           // Menyimpan foto baru
           $photoPath = $request->file('photo')->store('candidate_photos', 'public');
       } else {
           $photoPath = $candidate->photo; // Jika tidak ada foto baru, gunakan foto lama
       }

       // Update kandidat
       $candidate->update([
           'nama_ketua' => $validated['nama_ketua'],
           'nama_wakil' => $validated['nama_wakil'] ?? null,
           'visi' => $validated['visi'],
           'misi' => $validated['misi'],
           'program_kerja' => $validated['program_kerja'],
           'photo' => $photoPath,
       ]);

       // Redirect dengan pesan sukses
       return redirect()->route('admin.candidate.index')->with('status', 'Kandidat berhasil diperbarui!');
   }

   // Fungsi untuk menghapus kandidat
   public function destroy($id_candidate)
   {
       $candidate = Candidate::findOrFail($id_candidate);

       // Hapus foto jika ada
       if ($candidate->photo) {
           Storage::delete('public/' . $candidate->photo);
       }

       // Hapus kandidat
       $candidate->delete();

       // Redirect dengan pesan sukses
       return redirect()->route('admin.candidate.index')->with('status', 'Kandidat berhasil dihapus!');
   }
}

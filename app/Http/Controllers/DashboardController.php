<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
         // Ambil semua kandidat beserta jumlah suara (votes)
    $candidates = Candidate::withCount('votes')  // Menghitung jumlah votes terkait kandidat
    ->get();

    return view('dashboard', compact('candidates'));
        // Mengambil data total pengguna
        $totalUsers = User::count();

        // Mengambil data total pemilih yang sudah memilih
        $totalVoters = Vote::count();  // Asumsi Vote adalah tabel yang menyimpan data pemilih

        // Mengambil data total kandidat
        $totalCandidates = Candidate::count();

        // Mengambil statistik suara untuk setiap kandidat
        $candidates = Candidate::withCount('votes')->get(); // Mengambil data kandidat beserta jumlah suara

        return view('dashboard', compact('totalUsers', 'totalVoters', 'totalCandidates', 'candidates'));
    }
}

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
        // Mengambil data total pengguna
        $totalUsers = User::where('role', '!=', 'admin')->count();

        // Mengambil data total pemilih yang sudah memilih
        $totalVoters = Vote::whereNotNull('candidate_id')
        ->whereHas('user', function($query) {
            $query->where('role', '!=', 'admin');
        })
        ->count();

        // Mengambil data pemilih yang belum memilih (kecuali admin)
        $totalVotersNotVoted = User::doesntHave('vote')
                ->where('role', '!=', 'admin')
                ->count();

        // Mengambil data total kandidat
        $totalCandidates = Candidate::count();

        // Mengambil statistik suara untuk setiap kandidat
        $candidates = Candidate::withCount('votes')->get(); // Mengambil data kandidat beserta jumlah suara

        return view('dashboard', compact('totalUsers', 'totalVoters', 'totalVotersNotVoted', 'totalCandidates', 'candidates'));
    }
}


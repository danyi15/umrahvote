<?php

// app/Http/Controllers/VotingController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;



class VotingController extends Controller
{
   public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id_candidate',
        ]);

        // Cek apakah user sudah memilih
        $existingVote = Vote::where('user_id', Auth::id())->first();
        if ($existingVote) {
            return redirect()->back()->with('error', 'Anda sudah memberikan suara.');
        }

        // Simpan vote
        Vote::create([
            'candidate_id' => $request->candidate_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('voter.home')->with('success', 'Terima kasih telah memberikan suara!');
    }
}


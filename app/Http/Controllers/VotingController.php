<?php

// app/Http/Controllers/VotingController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use App\Events\VoteUpdated;


class VotingController extends Controller
{

    public function vote(Request $request)
    {
    $candidateId = $request->input('candidate_id');
    $candidate = Candidate::find($candidateId);

    if (!$candidate) {
        return response()->json(['error' => 'Candidate not found.'], 404);
    }

    $candidate->votes += 1;
    $candidate->save();

    Log::info('Vote Updated:', ['candidate' => $candidate]);
    // Trigger event broadcasting
    broadcast(new VoteUpdated($candidate));

    return response()->json(['message' => 'Vote recorded successfully.', 'candidate' => $candidate]);

}
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


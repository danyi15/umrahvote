@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="text-center">
        <h2 class="text-3xl font-bold text-blue-600 mb-8">Pilih Kandidat Anda</h2>
        <p class="text-lg text-gray-600 mb-12">Silakan pilih kandidat untuk memberikan suara Anda.</p>
    </div>

    <!-- Kandidat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($candidates as $candidate)
            <div class="max-w-xs mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                @if($candidate->photo)
                    <img src="{{ asset('storage/'.$candidate->photo) }}" alt="Foto Kandidat" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                        <span class="text-white">No Image</span>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">No Urut: {{ $candidate->id_candidate }}</h3>
                    <h4 class="text-lg text-gray-700">{{ $candidate->nama_ketua }}</h4>
                    <p class="text-gray-600 mt-4">{{ Str::limit($candidate->visi, 100) }}</p>  <!-- Show short preview of visi -->

                    <!-- Tombol Pilih Kandidat -->
                    <form action="{{ route('vote.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="candidate_id" value="{{ $candidate->id_candidate }}">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-200">
                            Pilih Kandidat
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

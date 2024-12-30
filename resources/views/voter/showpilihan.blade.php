@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="text-center">
        <h2 class="text-3xl font-bold text-blue-600 mb-8">Pilih Kandidat Anda</h2>
        <p class="text-lg text-gray-600 mb-12">Silakan pilih kandidat untuk memberikan suara Anda.</p>
    </div>

    <!-- Kandidat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($candidates as $index => $candidate)
            <div
                class="candidate-card max-w-xs mx-auto bg-white rounded-lg shadow-lg overflow-hidden cursor-pointer"
                data-order="{{ $index + 1 }}"
                onclick="handleCardClick(this)"
            >
                <!-- Foto Kandidat -->
                @if($candidate->photo)
                    <img src="{{ asset('storage/'.$candidate->photo) }}" alt="Foto Kandidat" class="w-full h-auto object-contain rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                        <span class="text-white">No Image</span>
                    </div>
                @endif

                <div class="p-6">
                    <!-- Nomor Urut -->
                    <p class="text-xl font-semibold text-gray-800 text-center">No Urut: {{ $index + 1 }}</p>
                    <br>
                    <!-- Nama Kandidat -->

                    <h4 class="text-xl font-medium text-gray-700 mb-4 text-center">Calon Presiden</h4>
                    <h5 class="text-xl font-semibold text-gray-800 mb-2 text-center">{{ $candidate->nama_ketua }}</h5>
                    <br>
                    <h4 class="text-xl font-medium text-gray-700 mb-4 text-center">Calon Wakil Presiden</h4>
                    <h4 class="text-lg font-semibold text-gray-700 mt-2 text-center">{{ $candidate->nama_wakil }}</h4>
                    <p class="text-gray-600 mt-4 text-center">{{ Str::limit($candidate->visi, 100) }}</p>  <!-- Show short preview of visi -->
                    <!-- Tombol Pilih Kandidat -->
                    @if(Auth::check() && Auth::user()->vote)
                        <div class="bg-green-100 p-4 rounded-lg shadow-lg mt-4 flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-2xl mr-4"></i>
                            <p class="text-green-600 font-semibold text-center">Terimakasih <br> Anda Sudah Memilih</p>
                        </div>
                    @else
                        <form action="{{ route('vote.store') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id_candidate }}">
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-200">
                                Pilih Kandidat
                            </button>
                        </form>
                    @endif

                    <!-- Tombol Lihat Detail -->
                    <a href="{{ route('voter.showdetail', $candidate->id_candidate) }}"
                       class="mt-4 inline-block w-full text-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200 ease-in-out">
                        Lihat Detail Kandidat
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bagian untuk Menampilkan Informasi Kandidat yang Dipilih -->

<script>
    // Fungsi untuk menangani klik pada kartu kandidat
    function handleCardClick(card) {
        // Ambil nomor urut dari atribut data-order
        const order = card.getAttribute('data-order');

        // Update pesan di bagian bawah
        const messageElement = document.getElementById('selected-card-message');
        messageElement.innerHTML = `Anda telah memilih kandidat dengan <strong>No Urut: ${order}</strong>.`;
    }
</script>
@endsection

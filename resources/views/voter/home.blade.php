@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="text-center">
        <h2 class="text-3xl font-bold text-blue-600 mb-8">Pilih Kandidat Anda</h2>
        <p class="text-lg text-gray-600 mb-12">Silakan pilih kandidat untuk memberikan suara Anda.</p>
    </div>

    <!-- Cek apakah profil lengkap -->
    @php
        $user = Auth::user();
    @endphp
    @if($user->address === 'Unknown Address' || $user->phone_number === '0000000000' || $user->NIK === 0)
    <div class="alert alert-warning text-center mb-6">
        <p class="text-yellow-600">Silakan lengkapi profil Anda terlebih dahulu sebelum memilih kandidat.</p>
        <br>
        <a href="{{ route('profile.edit') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-full">
            Lengkapi Profil
        </a>
    </div>
    @else
    <!-- Kandidat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Tombol Pilih Kandidat -->
        <div class="col-span-full text-center">
            <a href="{{ route('voter.showpilihan') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-200">
                Lihat Kandidat
            </a>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
    Swal.fire({
        icon: "success",
        title: "BERHASIL",
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
    @elseif(session('error'))
    Swal.fire({
        icon: "error",
        title: "GAGAL!",
        text: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 2000
    });
    @endif
</script>
@endsection

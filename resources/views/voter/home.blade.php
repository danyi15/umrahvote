@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="text-center">
        <h2 class="text-3xl font-bold text-blue-600 mb-8">Pilih Kandidat Anda</h2>
        <p class="text-lg text-gray-600 mb-12">Silakan pilih kandidat untuk memberikan suara Anda.</p>
    </div>

    <!-- Kandidat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Tombol Pilih Kandidat -->
        <div class="col-span-full text-center">
            <a href="{{ route('voter.showpilihan') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-200">
                Lihat Kandidat
            </a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header Kandidat -->
        <div class="bg-blue-600 p-6 text-white">
            <h2 class="text-2xl font-bold">{{ $candidate->nama_ketua }}</h2>
            <h3 class="text-xl font-semibold">{{ $candidate->nama_wakil }}</h3>
            {{-- <p class="mt-2">No Urut: {{ $order }}</p> --}}
        </div>

        <!-- Konten Kandidat -->
        <div class="p-6">
            <!-- Foto Kandidat -->
            <div class="mb-6">
                @if($candidate->photo)
                    <img src="{{ asset('storage/'.$candidate->photo) }}" alt="Foto Kandidat" class="w-full h-auto object-contain rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-300 flex items-center justify-center rounded-lg">
                        <span class="text-white">No Image</span>
                    </div>
                @endif
            </div>

            <!-- Visi Kandidat -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Visi:</h3>
                <p class="text-gray-600 mt-2">{{ $candidate->visi }}</p>
            </div>

            <!-- Misi Kandidat -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Misi:</h3>
                <ul class="list-disc list-inside text-gray-600 mt-2">
                    @foreach(explode("\n", $candidate->misi) as $misiItem)
                        <li>{{ $misiItem }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Tombol Kembali -->
            <button onclick="history.back()"
                class="mt-6 w-full inline-block px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition duration-200 ease-in-out">
                Kembali
            </button>
        </div>
    </div>
</div>
@endsection

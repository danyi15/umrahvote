@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Tambah Kandidat</h1>
    <form action="{{ route('admin.candidate.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="mb-4">
            <label for="nama_ketua" class="block text-gray-700 font-medium">Nama Ketua</label>
            <input type="text" name="nama_ketua" id="nama_ketua" class="form-control mt-2 w-full border rounded px-4 py-2" placeholder="Masukkan nama ketua" required>
        </div>
        <div class="mb-4">
            <label for="nama_wakil" class="block text-gray-700 font-medium">Nama Wakil</label>
            <input type="text" name="nama_wakil" id="nama_wakil" class="form-control mt-2 w-full border rounded px-4 py-2" placeholder="Masukkan nama wakil (opsional)">
        </div>
        <div class="mb-4">
            <label for="visi" class="block text-gray-700 font-medium">Visi</label>
            <textarea name="visi" id="visi" rows="4" class="form-control mt-2 w-full border rounded px-4 py-2" placeholder="Masukkan visi kandidat" required></textarea>
        </div>
        <div class="mb-4">
            <label for="misi" class="block text-gray-700 font-medium">Misi</label>
            <textarea name="misi" id="misi" rows="4" class="form-control mt-2 w-full border rounded px-4 py-2" placeholder="Masukkan misi kandidat" required></textarea>
        </div>
        <div class="mb-4">
            <label for="program_kerja" class="block text-gray-700 font-medium">Program Kerja</label>
            <textarea name="program_kerja" id="program_kerja" rows="4" class="form-control mt-2 w-full border rounded px-4 py-2" placeholder="Masukkan program kerja kandidat" required></textarea>
        </div>
        <div class="mb-4">
            <label for="photo" class="block text-gray-700 font-medium">Foto Kandidat</label>
            <input type="file" name="photo" id="photo" class="form-control mt-2 w-full border rounded px-4 py-2" accept="image/*">
        </div>
        <div>
            <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection

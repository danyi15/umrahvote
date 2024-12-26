@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Kandidat</h1>

    <!-- Menampilkan pesan status jika ada -->
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form untuk mengedit data kandidat -->
    <form action="{{ route('admin.candidate.update', $candidate->id_candidate) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama Ketua -->
        <div class="mb-3">
            <label for="nama_ketua" class="form-label">Nama Ketua</label>
            <input type="text" class="form-control @error('nama_ketua') is-invalid @enderror" id="nama_ketua" name="nama_ketua" value="{{ old('nama_ketua', $candidate->nama_ketua) }}" required>
            @error('nama_ketua')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nama Wakil -->
        <div class="mb-3">
            <label for="nama_wakil" class="form-label">Nama Wakil</label>
            <input type="text" class="form-control @error('nama_wakil') is-invalid @enderror" id="nama_wakil" name="nama_wakil" value="{{ old('nama_wakil', $candidate->nama_wakil) }}">
            @error('nama_wakil')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Visi -->
        <div class="mb-3">
            <label for="visi" class="form-label">Visi</label>
            <textarea class="form-control @error('visi') is-invalid @enderror" id="visi" name="visi" rows="4" required>{{ old('visi', $candidate->visi) }}</textarea>
            @error('visi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Misi -->
        <div class="mb-3">
            <label for="misi" class="form-label">Misi</label>
            <textarea class="form-control @error('misi') is-invalid @enderror" id="misi" name="misi" rows="4" required>{{ old('misi', $candidate->misi) }}</textarea>
            @error('misi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Program Kerja -->
        <div class="mb-3">
            <label for="program_kerja" class="form-label">Program Kerja</label>
            <textarea class="form-control @error('program_kerja') is-invalid @enderror" id="program_kerja" name="program_kerja" rows="4" required>{{ old('program_kerja', $candidate->program_kerja) }}</textarea>
            @error('program_kerja')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Foto -->
        <div class="mb-3">
            <label for="photo" class="form-label">Foto Kandidat</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
            @if($candidate->photo)
                <div class="mt-2">
                    <strong>Foto Saat Ini:</strong>
                    <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Candidate Photo" class="img-fluid" style="max-width: 150px;">
                </div>
            @endif
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Perbarui Kandidat</button>
        <a href="{{ route('admin.candidate.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Manajemen Kandidat</h1>
    <a href="{{ route('admin.candidate.create') }}" class="btn btn-primary mb-3">Tambah Kandidat</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Ketua</th>
                <th>Nama Wakil</th>
                <th>Foto</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->id_candidate }}</td>
                    <td>{{ $candidate->nama_ketua }}</td>
                    <td>{{ $candidate->nama_wakil }}</td>
                    <td>
                        <!-- Menampilkan foto jika ada -->
                        @if($candidate->photo)
                        <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Candidate Photo" class="img-fluid" style="max-width: 150px;">
                    @else
                        <span>Belum ada foto</span>
                    @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.candidate.edit', $candidate->id_candidate) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.candidate.destroy', $candidate->id_candidate) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

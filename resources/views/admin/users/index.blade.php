@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">Manajemen Pengguna</h1>
    <table class="min-w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-4 py-2 text-left text-gray-600">Nama</th>
                <th class="px-4 py-2 text-left text-gray-600">NIK</th>
                <th class="px-4 py-2 text-left text-gray-600">Alamat</th>
                <th class="px-4 py-2 text-left text-gray-600">Nomor Telepon</th>
                <th class="px-4 py-2 text-left text-gray-600">Email</th>
                <th class="px-4 py-2 text-left text-gray-600">Status</th>
                <th class="px-4 py-2 text-left text-gray-600">Created At</th>
                <th class="px-4 py-2 text-left text-gray-600">Aksi</th> <!-- Kolom Aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if ($user->role !== 'admin')
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->NIK }}</td>
                        <td class="px-4 py-2">{{ $user->address }}</td>
                        <td class="px-4 py-2">{{ $user->phone_number }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            @if ($user->vote)
                                <button class="bg-green-600 text-white px-4 py-2 rounded" disabled>
                                    Sudah
                                </button>
                            @else
                                <button class="bg-red-600 text-white px-4 py-2 rounded">
                                    Belum
                                </button>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2 flex space-x-2"> <!-- Kolom Aksi -->
                            <!-- Link Edit dengan rute admin.users.edit -->
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Edit</a>

                            <!-- Form untuk Hapus dengan rute admin.users.destroy -->
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
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

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-blue-600 p-6 text-white">
            <h2 class="text-2xl font-bold">Profil Pengguna</h2>
            <p>Kelola informasi pribadi Anda di sini.</p>
        </div>

        <div class="p-6">
            <!-- Tampilkan pesan sukses -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Informasi Pribadi</h3>

                <!-- Menampilkan data pengguna -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nama</label>
                    <p class="text-gray-900">{{ $user->name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Email</label>
                    <p class="text-gray-900">{{ $user->email }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">NIK</label>
                    <p class="text-gray-900">{{ $user->NIK }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Alamat</label>
                    <p class="text-gray-900">{{ $user->address }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nomor Handphone</label>
                    <p class="text-gray-900">{{ $user->phone_number }}</p>
                </div>
            </div>

            <!-- Tombol untuk menuju halaman edit -->
            <div class="mb-6">
                <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit Profil</a>
            </div>

            <!-- Form Update Password -->
            <div class="border-t pt-6 mt-6">
                <h3 class="text-xl font-semibold mb-4">Ubah Password</h3>
                <form action="{{ route('profile.updatePassword') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="current_password" class="block font-medium text-gray-700">Password Lama</label>
                        <input type="password" name="current_password" id="current_password" class="w-full p-2 border rounded">
                    </div>

                    <div class="mb-4">
                        <label for="new_password" class="block font-medium text-gray-700">Password Baru</label>
                        <input type="password" name="new_password" id="new_password" class="w-full p-2 border rounded">
                    </div>

                    <div class="mb-4">
                        <label for="new_password_confirmation" class="block font-medium text-gray-700">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full p-2 border rounded">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ubah Password</button>
                </form>
            </div>
        </div>
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

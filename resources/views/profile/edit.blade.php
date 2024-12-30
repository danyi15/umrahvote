<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">Edit Profil</h1>

    <!-- Formulir Edit Profil -->
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <div class="mb-4">
            <label for="NIK" class="block text-gray-700">NIK</label>
            <input type="text" id="NIK" name="NIK" value="{{ old('NIK', $user->NIK) }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700">Alamat</label>
            <textarea id="address" name="address" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('address', $user->address) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-gray-700">Nomor Telepon</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('profile.show') }}" class="text-blue-600 hover:text-blue-800">Kembali ke Profil</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-800">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">Edit Pengguna</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-600">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- NIK -->
        <div class="mb-4">
            <label for="NIK" class="block text-sm font-medium text-gray-600">NIK</label>
            <input type="text" id="NIK" name="NIK" value="{{ old('NIK', $user->NIK) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-600">Alamat</label>
            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Nomor Telepon -->
        <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-600">Nomor Telepon</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection

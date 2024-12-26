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
                    </tr>
                @endif
            @endforeach
        </tbody>

    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="row justify-content-center">
        <!-- Dashboard Card -->
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-blue-600 text-white text-xl font-semibold">{{ __('Dashboard Admin') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-6 p-4 rounded bg-green-100 text-green-800" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Teks Selamat Datang -->
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">Welcome, Admin</h2>
                        <p class="text-muted text-lg">Manage voters and candidates from this dashboard.</p>
                    </div>

                    <!-- Tabel Kandidat -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

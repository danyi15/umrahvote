@extends('layouts.app')

@section('content')
<main class="bg-white-50 dark:bg-white-900 py-8 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Dashboard Header -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-8 mb-6">
            <h2 class="text-3xl font-semibold text-blue-600 dark:text-blue-500">Dashboard</h2>
            <p class="text-black-600 dark:text-black-300 mt-2">Selamat datang, {{ Auth::user()->name }}! Berikut adalah statistik pemungutan suara dan data pengguna.</p>
        </div>

        <!-- Statistik Pemungutan Suara -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-4">Statistik Pemungutan Suara</h3>
                <canvas id="voteChart" width="400" height="200"></canvas>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-4">Aktivitas Terbaru</h3>
                <ul class="space-y-4">
                    @foreach($candidates as $candidate)
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-black-300">{{ $candidate->name }} - {{ $candidate->votes_count }} Suara</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Ringkasan Data Pengguna -->
        {{-- <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-4">Ringkasan Data Pengguna</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-blue-50 dark:bg-blue-700 p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-blue-600 dark:text-blue-400">Total Pengguna</h4>
                    <p class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $totalUsers }}</p>
                </div>
                <div class="bg-green-50 dark:bg-green-700 p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-green-600 dark:text-green-400">Pemilih Terdaftar</h4>
                    <p class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $totalVoters }}</p>
                </div>
                <div class="bg-yellow-50 dark:bg-yellow-700 p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-yellow-600 dark:text-yellow-400">Kandidat Terdaftar</h4>
                    <p class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $totalCandidates }}</p>
                </div>
            </div> --}}
        </div>
    </div>
</main>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('voteChart').getContext('2d');

    // Mengambil nama kandidat dan jumlah suara
    const candidatesNames = @json($candidates->pluck('nama_ketua'));
    const votesCount = @json($candidates->pluck('votes_count'));

    const voteChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: candidatesNames,  // Nama kandidat sebagai label
            datasets: [{
                label: 'Jumlah Suara',
                data: votesCount,  // Jumlah suara per kandidat
                backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


@endsection

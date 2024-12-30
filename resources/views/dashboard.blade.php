@extends('layouts.app')

@section('content')
<main class="bg-white-50 dark:bg-white-900 py-8 px-6">
    <div style="position: relative; padding-top: 56.25%; overflow: hidden; background-color: #f4f4f4; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <iframe src="http://localhost/realtimepart/"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"></iframe>
    </div>
    <div class="max-w-7xl mx-auto" hidden>
        <!-- Dashboard Header -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-8 mb-6">
            <h2 class="text-3xl font-semibold text-blue-600 dark:text-blue-500">Dashboard</h2>
            <p class="text-black-600 dark:text-black-300 mt-2">Selamat datang, {{ Auth::user()->name }}! Berikut adalah statistik pemungutan suara dan data pengguna.</p>
        </div>

        <!-- Statistik untuk Admin -->
        @if(Auth::user()->hasRole('admin'))
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Statistik Pemungutan Suara untuk Admin -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-4">Statistik Pemungutan Suara</h3>
                    <canvas id="voteChart" width="400" height="200"></canvas>
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-4">Aktivitas Terbaru</h3>
                    <ul class="space-y-4">
                        @foreach($candidates as $candidate)
                            <li class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-black-300">{{ $candidate->nama_ketua }} - {{ $candidate->votes_count }} Suara</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Ringkasan Data Pengguna untuk Admin -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-4">Ringkasan Data Pengguna</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-blue-50 dark:bg-blue-700 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold text-blue-600 dark:text-blue-400">Total Pemilih</h4>
                        <p class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $totalUsers }}</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-700 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold text-green-600 dark:text-green-400">Pemilih Yang Sudah Memlih</h4>
                        <p class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $totalVoters }}</p>
                        <h4 class="text-lg font-semibold text-red-600 dark:text-red-400">Pemilih Yang Belum Memilih</h4>
                        <p class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $totalVotersNotVoted }}</p>
                    </div>
                    <div class="bg-yellow-50 dark:bg-yellow-700 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold text-yellow-600 dark:text-yellow-400">Kandidat Terdaftar</h4>
                        <p class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $totalCandidates }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Statistik Pemungutan Suara untuk User -->
        @if(Auth::user()->hasRole('user'))
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-4">Statistik Pemungutan Suara</h3>
                <canvas id="voteChart" width="400" height="200"></canvas>
            </div>
        @endif
    </div>
</main>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('voteChart').getContext('2d');

    // Mengambil nama kandidat dan jumlah suara
    const candidatesNames = @json($candidates->pluck('nama_ketua')->all());
    const votesCount = @json($candidates->pluck('votes_count')->all());

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

<script src="https://cdn.jsdelivr.net/npm/@laravel/echo@1.11.0/dist/echo.js"></script>

<script>
    window.Echo.channel('votes')
        .listen('VoteUpdated', (event) => {
            updateVoteCount(event.candidate);
        });

    function updateVoteCount(candidate) {
        // Update suara pada tampilan
        const candidateElement = document.querySelector(`#candidate-${candidate.id}`);
        if (candidateElement) {
            candidateElement.querySelector('.votes-count').textContent = candidate.votes_count;
        }

        // Update Chart.js
        const index = candidatesNames.indexOf(candidate.nama_ketua);
        if (index !== -1) {
            votesCount[index] = candidate.votes_count;  // Update votesCount array
            voteChart.update(); // Update chart
        }
    }
</script>

@endsection

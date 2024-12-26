@extends('layouts.app')

@section('content')
<!-- Main Content -->
<main class="flex-grow">
    <div class="container mx-auto px-6 py-12">
        <!-- Card untuk Judul dan Deskripsi -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-4">Selamat Datang di Dashboard</h2>
            <p class="text-gray-600 dark:text-gray-300 text-lg">Silakan pilih menu di atas untuk melanjutkan.</p>
        </div>

        <!-- Grafik Statistik -->
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 shadow-lg">
            <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-4">Statistik Pemungutan Suara</h3>
            <canvas id="voteChart" width="400" height="200"></canvas>
        </div>
    </div>
</main>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('voteChart').getContext('2d');
    const voteChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Kandidat A', 'Kandidat B', 'Kandidat C'],
            datasets: [{
                label: 'Jumlah Suara',
                data: [25, 15, 10],
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

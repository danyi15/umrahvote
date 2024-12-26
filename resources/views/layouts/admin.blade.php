<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <!-- Tambahkan CSS Bootstrap atau lainnya -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-light sidebar py-4">
                <h5 class="text-center">Admin Panel</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.home') }}" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.candidate.index') }}" class="nav-link">Manajemen Kandidat</a>
                    </li>
                    <!-- Tambahkan menu lainnya -->
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Tambahkan JS Bootstrap atau lainnya -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

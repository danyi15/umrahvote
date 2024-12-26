<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div id="app">
        <nav class="bg-white shadow-md">
            <div class="container mx-auto flex justify-between items-center py-4 px-6">
                <a href="{{ url('/') }}" class="text-2xl font-semibold text-blue-600">UMRAH VOTE</a>

                <div class="space-x-4 flex items-center">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Register</a>
                    @else
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-blue-600">Manajemen Pengguna</a>
                            <a href="{{ route('admin.candidate.index') }}" class="text-gray-600 hover:text-blue-600">Manajemen Kandidat</a>
                        @elseif (Auth::user()->hasRole('user'))
                            <a href="{{ route('voter.showpilihan') }}" class="text-gray-600 hover:text-blue-600">Pilih Kandidat</a>
                        @endif

                        <div class="relative">
                            <button class="text-gray-600 hover:text-blue-600 flex items-center space-x-2" id="userDropdownButton" aria-expanded="false" aria-haspopup="true">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.828l3.71-3.63a.75.75 0 111.04 1.08l-4.25 4.17a.75.75 0 01-1.04 0l-4.25-4.17a.75.75 0 01-.02-1.06z" clip-rule="evenodd"></path>
                                </svg>
                            </button>

                            <div id="userDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white shadow-md rounded-md text-gray-700 hidden">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm">Profil</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:text-red-800">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>



        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript to Toggle Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropdownButton = document.getElementById('userDropdownButton');
            const dropdownMenu = document.getElementById('userDropdownMenu');

            if (dropdownButton && dropdownMenu) {
                dropdownButton.addEventListener('click', function () {
                    dropdownMenu.classList.toggle('hidden');
                });

                window.addEventListener('click', function (event) {
                    if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>

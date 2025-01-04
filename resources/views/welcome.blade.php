@extends('layouts.app')

@section('content')
<!-- Main Content -->
<main class="flex-grow bg-gray-100 py-12">
    <div class="container mx-auto px-6">

        <!-- Hero Section with Welcome Message and Call to Action -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-600 mb-4">Selamat Datang di Sistem Pemilihan Kami</h2>
            <p class="text-gray-700 text-lg mb-6">Kami mengajak Anda untuk berpartisipasi aktif dalam pemilihan dengan memilih kandidat terbaik yang akan membawa perubahan positif. Bergabunglah dengan kami dan pilih dengan bijak!</p>

            <!-- Himbauan untuk Mendaftar -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum punya akun?</h3>
                <p class="text-gray-600 text-md mb-4">Daftar sekarang dan mulai memilih kandidat terbaik yang sesuai dengan visi dan misi Anda!</p>
                <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 transition duration-300">Daftar Sekarang</a>
            </div>

            <!-- Gambar Ilustrasi -->


        </div>

        <!-- Himbauan Memilih Kandidat yang Baik -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <h3 class="text-2xl font-semibold text-blue-600 mb-4">Pilih Kandidat yang Baik</h3>
            <p class="text-gray-700 text-lg mb-6">Pemilihan adalah kesempatan Anda untuk menentukan masa depan. Pilihlah kandidat yang memiliki integritas, visi, dan misi yang jelas untuk kepentingan bersama.</p>
            <a href="{{ route('voter.showpilihan') }}" class="inline-block bg-green-600 text-white py-2 px-6 rounded-md hover:bg-green-700 transition duration-300">Mulai Memilih</a>
        </div>

    </div>
</main>
  <!-- SweetAlert Notification -->
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

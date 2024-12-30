@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-6">Login</h2>
            <p class="text-center text-gray-600 mb-6">Please sign in to continue</p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg space-y-6">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input id="email" name="email" type="email" required autocomplete="email" autofocus
                        class="mt-2 px-3 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">

                    @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="mt-2 px-3 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password') border-red-500 @enderror">

                    @error('password')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Forgot your password?
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
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

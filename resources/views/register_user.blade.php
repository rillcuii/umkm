<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white min-h-screen flex items-center justify-center px-4">
    <!-- Formulir Registrasi -->
    <div class="max-w-md w-full mb-16">

        <form method="POST" action="{{ route('register.pelanggan.submit') }}" class="w-full max-w-md">
            @csrf

            <div class="flex justify-center">
                <img src="{{ asset('img/logo-umkm.png') }}" alt="Logo UMKM Lard" class="h-36">
            </div>

            <h1 class="text-center text-gray-700 font-bold mb-6 mt-4 text-xl">Daftar Customer</h1>

            <!-- Input Username -->
            <div class="mb-4 ">
                <label for="username" class="block text-sm mb-1 font-bold text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                    class=" rounded-lg w-full px-4 py-2 border border-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                @error('username')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Nama Lengkap -->
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-sm mb-1 font-bold text-gray-700">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                    class="w-full px-4  rounded-lg py-2 border border-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                @error('nama_lengkap')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm mb-1 font-bold text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4  rounded-lg py-2 border border-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="block text-sm mb-1 font-bold text-gray-700">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full px-4  rounded-lg py-2 border border-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            </div>

            <p class="text-gray-500 text-xs text-center mb-3">
                Sudah Punya Akun?
                <a href="{{ route('login') }}" class="text-purple-500 hover:underline">Masuk</a>
            </p>

            <!-- Tombol Registrasi -->
            <button type="submit"
                class="w-full  rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3 font-bold hover:from-pink-500 hover:to-purple-500 transition-all duration-200">
                Register Sebagai Pelanggan
            </button>
        </form>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white min-h-screen flex items-center justify-center px-4">

    <!-- Kontainer Utama -->
    <div class="max-w-md w-full mb-24">
        <!-- Logo -->
        <div class="flex justify-center">
            <img src="{{ asset('img/logo-umkm.png') }}" alt="Logo UMKM Lard" class="h-36">
        </div>

        <h1 class="text-center text-gray-700 font-bold mb-6 mt-4 text-2xl">Login</h1>


        <!-- Pesan Error -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulir -->
        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Input Username -->
            <div>
                <label for="username" class="block text-sm mb-1 font-bold text-gray-700">Masukkan Username</label>
                <input type="text" id="username" name="username" placeholder="username" required
                    class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            </div>

            <!-- Input Password -->
            <div>
                <label for="password" class="block text-sm mb-1 font-bold text-gray-700">Masukkan Password</label>
                <input type="password" id="password" name="password" placeholder="password" required
                    class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            </div>

            <!-- Ketentuan -->
            <p class="text-gray-500 text-xs text-center">
                Anda Belum Punya Akun?
                <a href="{{ route('umkm.register') }}" class="text-purple-500 hover:underline">Registrasi UMKM</a> atau
                <a href="{{ route('register.pelanggan') }}" class="text-purple-500 hover:underline">Registrasi
                    Customer</a>.
            </p>

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3 rounded-lg font-bold hover:from-pink-500 hover:to-purple-500 transition-all duration-200">
                Login
            </button>
        </form>
    </div>

</body>

</html>

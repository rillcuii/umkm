<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</head>

<body>

    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                    <!-- Jika pengguna sudah login -->
                    @if (Auth::check())
                        <li>
                            <a href="{{ route('history.transaksi') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                {{ Auth::user()->nama_lengkap }} - History Transaksi
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500">
                                    Logout
                                </button>
                            </form>
                        </li>
                        <!-- Jika pengguna belum login -->
                    @else
                        <li>
                            <a href="{{ route('login') }}"
                                class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
                                aria-current="page">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register.pelanggan') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register
                                user</a>
                        </li>
                        <li>
                            <a href="{{ route('umkm.register') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register
                                Umkm</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner Section -->
    <div class="banner-container mb-8">
        @foreach ($banners as $banner)
            <div class="banner-item">
                <a href="{{ $banner->link }}">
                    <img src="{{ asset('storage/banner/' . $banner->link) }}" alt="Banner" class="w-full h-auto">
                </a>
            </div>
        @endforeach
    </div>

    <!-- Daftar UMKM -->
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Daftar UMKM dengan Status Aktif</h1>

        <!-- Filter Kategori -->
        <div class="mb-4">
            <form method="GET" action="{{ route('index') }}">
                <label for="kategori" class="mr-2">Pilih Kategori:</label>
                <select name="kategori" id="kategori" class="border rounded p-2">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}"
                            {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded">Filter</button>
            </form>
        </div>

        <!-- Daftar UMKM yang Terfilter -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($umkms as $umkm)
                <div class="border p-4 rounded-lg shadow-md bg-white">
                    <a href="{{ route('umkm.show', $umkm->id_umkm) }}" class="block">
                        <h2 class="text-xl font-bold">{{ $umkm->nama_umkm }}</h2>
                        <p><strong>Alamat:</strong> {{ $umkm->alamat_pemilik }}</p>
                        @if ($umkm->foto_umkm)
                            <img src="{{ asset('storage/foto_umkm/' . $umkm->foto_umkm) }}" alt="Foto UMKM"
                                class="mt-4 w-full h-48 object-cover rounded-lg">
                        @endif
                    </a>
                </div>
            @empty
                <p class="text-center col-span-3 text-gray-500">Belum ada UMKM yang terdaftar.</p>
            @endforelse
        </div>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Registrasi Pemilik UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body class="bg-white min-h-screen flex items-center justify-center px-4">
    <!-- Kontainer Utama -->
    <div class="max-w-3xl w-full mx-auto">
        <form action="{{ route('umkm.register.submit') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @csrf

            <div class="md:col-span-2 flex justify-center mb-3">
                <img src="{{ asset('img/logo-umkm.png') }}" alt="Logo UMKM" class="h-12 md:h-16">
            </div>

            <h1 class="md:col-span-2 text-center text-gray-700 font-bold mb-3 text-lg">Daftar Pemilik UMKM</h1>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="email@example.com" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-xs font-bold text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Nama UMKM -->
            <div>
                <label for="nama_umkm" class="block text-xs font-bold text-gray-700 mb-1">Nama UMKM</label>
                <input type="text" id="nama_umkm" name="nama_umkm" placeholder="Nama UMKM" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Foto Profil -->
            <div>
                <label for="foto_profil" class="block text-xs font-bold text-gray-700 mb-1">Foto Profil</label>
                <input type="file" id="foto_profil" accept=".png, .jpg, .jpeg" name="foto_profil" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Foto UMKM -->
            <div>
                <label for="foto_umkm" class="block text-xs font-bold text-gray-700 mb-1">Foto UMKM</label>
                <input type="file" id="foto_umkm" accept=".png, .jpg, .jpeg" name="foto_umkm" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Nomor Handphone -->
            <div>
                <label for="nomer_handphone" class="block text-xs font-bold text-gray-700 mb-1">Nomor Handphone</label>
                <input type="number" id="nomer_handphone" name="nomer_handphone" placeholder="Nomor Handphone" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Alamat Pemilik -->
            <div>
                <label for="alamat_pemilik" class="block text-xs font-bold text-gray-700 mb-1">Alamat Pemilik</label>
                <textarea id="alamat_pemilik" name="alamat_pemilik" rows="2" placeholder="Alamat Lengkap" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs"></textarea>
            </div>

            <!-- Kode Pos -->
            <div>
                <label for="kode_pos" class="block text-xs font-bold text-gray-700 mb-1">Kode Pos</label>
                <input type="text" id="kode_pos" name="kode_pos" placeholder="Kode Pos" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Usia -->
            <div>
                <label for="usia" class="block text-xs font-bold text-gray-700 mb-1">Usia</label>
                <input type="number" id="usia" name="usia" placeholder="Usia" min="18" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label for="jenis_kelamin" class="block text-xs font-bold text-gray-700 mb-1">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <!-- Provinsi -->
            <div>
                <label for="provinsi" class="block text-xs font-bold text-gray-700 mb-1">Provinsi</label>
                <select id="provinsi" name="provinsi" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
                    <option value="">Pilih Provinsi...</option>
                    @foreach ($provinces as $provinsi)
                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Kabupaten/Kota -->
            <div>
                <label for="kabupaten_kota" class="block text-xs font-bold text-gray-700 mb-1">Kabupaten/Kota</label>
                <select id="kabupaten_kota" name="kabupaten_kota" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs"></select>
            </div>

            <!-- Kecamatan -->
            <div>
                <label for="kecamatan" class="block text-xs font-bold text-gray-700 mb-1">Kecamatan</label>
                <select id="kecamatan" name="kecamatan" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs"></select>
            </div>

            <!-- Kelurahan -->
            <div>
                <label for="kelurahan" class="block text-xs font-bold text-gray-700 mb-1">Kelurahan/Desa</label>
                <select id="desa" name="kelurahan" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs"></select>
            </div>

            <!-- Status Kepemilikan -->
            <div>
                <label for="status_kepemilikan" class="block text-xs font-bold text-gray-700 mb-1">Status
                    Kepemilikan</label>
                <select id="status_kepemilikan" name="status_kepemilikan" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
                    <option value="individu">Individu</option>
                    <option value="kelompok">Kelompok</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required
                    class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 transition text-xs">
            </div>

            <!-- Teks dan Tombol -->
            <p class="md:col-span-2 text-center text-xs text-gray-500 mb-3">
                Sudah Punya Akun?
                <a href="{{ route('login') }}" class="text-purple-500 hover:underline">Masuk</a>
            </p>

            <div class="md:col-span-2">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-2 rounded-lg font-bold hover:from-pink-500 hover:to-purple-500 transition-all duration-200 text-sm">
                    Daftar Pemilik UMKM
                </button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Set CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#provinsi').on('change', function() {
                let id_provinsi = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('getkabupaten') }}",
                    data: {
                        id_provinsi: id_provinsi
                    },
                    cache: false,

                    success: function(msg) {
                        $('#kabupaten_kota').html(msg);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
            $('#kabupaten_kota').on('change', function() {
                let id_kabupaten = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('getkecamatan') }}",
                    data: {
                        id_kabupaten: id_kabupaten
                    },
                    cache: false,

                    success: function(msg) {
                        $('#kecamatan').html(msg);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
            $('#kecamatan').on('change', function() {
                let id_kecamatan = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('getdesa') }}",
                    data: {
                        id_kecamatan: id_kecamatan
                    },
                    cache: false,

                    success: function(msg) {
                        $('#desa').html(msg);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>

</body>

</html>

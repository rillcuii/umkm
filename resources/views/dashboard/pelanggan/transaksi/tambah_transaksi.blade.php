<meta name="csrf-token" content="{{ csrf_token() }}">
<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf

    <!-- Nama Lengkap -->
    <div class="mb-4">
        <label for="nama_lengkap" class="block">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full p-2 border rounded" required>
    </div>

    <!-- Nomor Telepon -->
    <div class="mb-4">
        <label for="nomor_telepon" class="block">Nomor Telepon</label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" class="w-full p-2 border rounded" required>
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="block">Email</label>
        <input type="email" name="email" id="email" class="w-full p-2 border rounded" required>
    </div>

    <!-- Alamat -->
    <div class="mb-4">
        <label for="alamat" class="block">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="w-full p-2 border rounded" required>
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

    <!-- Jumlah Produk -->
    <div class="mb-4">
        <label for="jumlah" class="block">Jumlah Produk</label>
        <input type="number" name="jumlah" id="jumlah" class="w-full p-2 border rounded" required min="1"
            value="1">
    </div>

    <!-- Hidden Fields for UMKM and Produk IDs -->
    <input type="hidden" name="id_umkm" value="{{ $umkm->id_umkm }}">
    <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Pesan Sekarang</button>
</form>
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

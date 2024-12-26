<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    
    <title>Document</title>
</head>

<body>
    <form action="{{ route('umkm.register.submit') }}" method="POST">
        @csrf
        <!-- Data Pemilik UMKM -->
        <input type="text" name="email" placeholder="Email" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
        <input type="text" name="nomer_handphone" placeholder="Nomor Handphone" required>
        <input type="text" name="alamat_pemilik" placeholder="Alamat Pemilik" required>
        <input type="text" name="kode_pos" placeholder="Kode Pos" required>
        <input type="text" name="usia" placeholder="Usia" required>

        <!-- Jenis Kelamin -->
        <select name="jenis_kelamin" required>
            <option value="laki-laki">Laki-laki</option>
            <option value="perempuan">Perempuan</option>
        </select>

        <!-- Provinsi -->
        <select name="provinsi" id="provinsi" required>
            <option value="plih provinsi">plih provinsi...</option>
            @foreach ($provinces as $provinsi)
                <option value={{ $provinsi->id }}>
                    {{ $provinsi->name }}
                </option>
            @endforeach
        </select>

        <!-- Kabupaten/Kota -->
        <select name="kabupaten_kota" id="kabupaten_kota" required>

        </select>

        <!-- Kecamatan -->
        <select name="kecamatan" id="kecamatan" required>
            
        </select>

        <!-- Kelurahan -->
        <select name="kelurahan" id="desa" required>

        </select>

        <!-- Status Kepemilikan -->
        <select name="status_kepemilikan" required>
            <option value="individu">Individu</option>
            <option value="kelompok">Kelompok</option>
            <option value="lainnya">Lainnya</option>
        </select>

        <!-- Pilih Produk (opsional) -->
        <select name="id_produk">
            <option value="">Pilih Produk (Opsional)</option>
            @foreach ($produk as $prod)
                <option value="{{ $prod->id_produk }}">{{ $prod->nama_produk }}</option>
            @endforeach
        </select>

        <!-- Password -->
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Daftar</button>
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
</body>

</html>

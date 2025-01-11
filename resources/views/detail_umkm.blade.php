<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail UMKM</title>
</head>

<body>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold">{{ $umkm->nama_umkm }}</h1>
        <p><strong>Deskripsi UMKM:</strong> {{ $umkm->deskripsi }}</p>
        <p><strong>Alamat:</strong> {{ $umkm->alamat_pemilik }}</p>

        @if ($umkm->foto_umkm)
            <img src="{{ asset('storage/foto_umkm/' . $umkm->foto_umkm) }}" alt="Foto UMKM"
                class="mt-4 w-full h-48 object-cover rounded-lg">
        @endif

        <h2 class="mt-6 text-2xl font-bold">Produk yang Dijual</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach ($produk as $item)
                <div class="border p-4 rounded-lg shadow-md bg-white">
                    <h3 class="text-xl font-bold">{{ $item->nama_produk }}</h3>
                    <p><strong>Harga:</strong> {{ number_format($item->harga) }}</p>
                    <p><strong>Stok:</strong> {{ number_format($item->stok) }}</p>

                    @if ($item->foto_produk)
                        <img src="{{ asset('storage/produk/' . $item->foto_produk) }}" alt="Foto Produk"
                            class="mt-4 w-full h-48 object-cover rounded-lg">
                    @endif

                    <a href="{{ route('transaksi.create', ['id_umkm' => $umkm->id_umkm, 'id_produk' => $item->id_produk]) }}"
                        class="mt-4 block bg-blue-500 text-white text-center py-2 rounded">Pesan</a>
                </div>
            @endforeach
        </div>

        <a href="{{ route('pelanggan.messages.show', ['id_user' => auth()->id(), 'id_umkm' => $umkm->id_umkm]) }}"
            class="btn btn-primary">Chat umkm</a>
    </div>
</body>

</html>

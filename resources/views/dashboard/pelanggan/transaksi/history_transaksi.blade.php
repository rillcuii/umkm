<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>History Transaksi</title>
</head>

<body>
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">History Transaksi</h1>

        @if ($transaksis->isEmpty())
            <p class="text-center">Anda belum melakukan transaksi.</p>
        @else
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        {{-- <th class="px-4 py-2 border">Nama UMKM</th> --}}
                        {{-- <th class="px-4 py-2 border">Nama Produk</th> --}}
                        {{-- <th class="px-4 py-2 border">Jumlah</th> --}}
                        {{-- <th class="px-4 py-2 border">Total Harga</th> --}}
                        {{-- <th class="px-4 py-2 border">Tanggal Transaksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $transaksi)
                        <div class="border p-4 rounded-lg shadow-md bg-white">
                            {{-- <h3 class="text-xl font-bold">Transaksi Produk: {{ $transaksi->produk->nama_produk }}</h3> --}}
                            <p><strong>UMKM:</strong> {{ $transaksi->umkm->nama_umkm }}</p>
                            <p><strong>Jumlah:</strong> {{ $transaksi->jumlah }}</p>
                            <p><strong>Status:</strong> {{ $transaksi->status }}</p>
                            {{-- <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d-m-Y') }}</p> --}}
                        </div>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>

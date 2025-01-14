@extends('navbar')
@section('navbar')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>History Transaksi</title>
    </head>

    <body class="flex flex-col min-h-screen">
        <!-- breadcrumb -->
        <div class="flex p-6 font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-900 hover:text-gray-700">
                            Pembelian
                        </a>
                    </div>
                </li>
            </ol>
        </div>

        <div class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-32">
            <h1 class="font-bold md:mb-14 mb-4 text-2xl">Pesanan Saya</h1>

            <!-- Transaction Cards -->
            <div class="space-y-4">
                @if ($transaksis->isEmpty())
                    <p class="text-center">Anda belum melakukan transaksi.</p>
                @else
                    @foreach ($transaksis as $transaksi)
                        @foreach ($transaksi->umkm->produk as $produk)
                            <div class="flex flex-col md:flex-row justify-between p-4 rounded-2xl border border-gray-200">
                                <!-- Left: Restaurant Image, Name, and Transaction Details -->
                                <div class="flex flex-col md:flex-row items-start md:items-center md:w-2/3">
                                    <!-- Restaurant Image (Desktop: Left of content) -->
                                    <div class="w-full md:w-16 mb-4 md:mb-0">
                                        <img src="{{ asset('storage/produk/' . $produk->foto_produk) }}"
                                            alt="Restaurant Image"
                                            class="rounded-lg shadow-md w-full h-auto md:w-16 md:h-16 object-cover" />
                                    </div>

                                    <!-- Transaction Details -->
                                    <div class="flex flex-col justify-center md:ml-2">
                                        <div class="text-sm font-semibold text-gray-600">
                                            {{ $transaksi->umkm->nama_umkm }}
                                        </div>
                                        <div class="text-sm text-gray-500 mt-1">
                                            {{ $transaksi->umkm->produk->first()->nama_produk }} - {{ $transaksi->jumlah }}
                                            {{ $transaksi->umkm->produk->first()->satuan }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Right: Status and Date -->
                                <div class="flex flex-col justify-center items-end text-right md:w-1/3 mt-2 md:mt-0">
                                    <div
                                        class="text-sm font-semibold 
                                    text-{{ $transaksi->status == 'diproses'
                                        ? 'yellow'
                                        : ($transaksi->status == 'diterima'
                                            ? 'blue'
                                            : ($transaksi->status == 'selesai'
                                                ? 'green'
                                                : 'gray')) }}-500">
                                        {{ $transaksi->status }}
                                    </div>
                                    <div class="text-xs font-semibold text-gray-500">
                                        {{ $transaksi->created_at->translatedFormat('l, d F Y') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </body>

    </html>
    @include('footer')
@endsection

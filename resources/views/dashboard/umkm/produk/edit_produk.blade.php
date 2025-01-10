@extends('dashboard.umkm.layout_umkm.menu')
@section('sidebar_umkm')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Responsive Sidebar with Add Data Form</title>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100">

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64">
            <main class="p-5 md:p-10 space-y-8">
                <div class="container mx-auto p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        Edit Data Produk
                    </h2>

                    <form
                        action="{{ route('umkm.update.produk', ['id_produk' => $produk->id_produk, 'id_umkm' => $id_umkm]) }}"
                        method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Produk</label>
                            <input type="text" id="nama_produk" name="nama_produk"
                                class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('nama_produk', $produk->nama_produk) }}" placeholder="Nama Produk" required />
                        </div>

                        <div>
                            <label for="Stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                            <input type="text" id="stok" name="stok"
                                class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('stok', $produk->stok) }}" placeholder="Stok" required />
                        </div>

                        <div>
                            <label for="Harga" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="text" id="harga" name="harga"
                                class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('harga', $produk->harga) }}" placeholder="Harga" required />
                        </div>

                        <div>
                            <label for="foto_produk" class="block text-sm font-medium text-gray-700 mb-1">Foto
                                Produk</label>
                            <input type="file" id="foto_produk" name="foto_produk" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                required />
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('umkm.index.produk', ['id_umkm' => $produk->id_umkm]) }}"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                                Kembali
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </body>

    </html>
@endsection

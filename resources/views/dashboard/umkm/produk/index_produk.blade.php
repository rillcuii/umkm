@extends('dashboard.umkm.layout_umkm.menu')
@section('sidebar_umkm')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Produk</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @keyframes fadeIn {
                0% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            .animate-fade-in {
                animation: fadeIn 1s ease-in forwards;
            }
        </style>
    </head>

    <body class="bg-gray-100">

        <!-- Main Content -->
        <div class="flex-1 ml-0 lg:ml-64">
            <main class="p-5 md:p-10 space-y-8 opacity-0 animate-fade-in">
                <div class="container mx-auto p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Produk</h2>
                    <div class="flex justify-end mb-4">
                        <button onclick="openAddProductModal()"
                            class="flex items-center space-x-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 hover:scale-105 transform transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Produk</span>
                        </button>
                    </div>
                    <!-- Responsif Table -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama Produk</th>
                                    <th scope="col" class="px-6 py-3">Foto Produk</th>
                                    <th scope="col" class="px-6 py-3">Stok</th>
                                    <th scope="col" class="px-6 py-3">Harga</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($produk as $s)
                                    <tr class="hover:bg-gray-100 transition-transform duration-200">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $s->nama_produk }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('storage/produk/' . $s->foto_produk) }}" alt="Foto Produk"
                                                class="h-16 w-16 object-cover rounded" />
                                        </td>
                                        <td class="px-6 py-4">{{ $s->stok }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <!-- Switch Toggle -->
                                            <form action="{{ route('umkm.update.status') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_produk" value="{{ $s->id_produk }}">
                                                <input type="hidden" name="status"
                                                    value="{{ $s->status == 'on' ? 'off' : 'on' }}">

                                                <label class="inline-flex relative items-center cursor-pointer">
                                                    <input type="checkbox" class="sr-only peer"
                                                        onchange="this.form.submit()"
                                                        {{ $s->status == 'on' ? 'checked' : '' }} />
                                                    <div
                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full 
                                                            peer peer-checked:bg-green-500 peer-checked:after:translate-x-full peer-checked:after:border-white
                                                            after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300
                                                            after:border after:rounded-full after:h-5 after:w-5 after:transition-all">
                                                    </div>
                                                </label>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('umkm.edit.produk', ['id_produk' => $s->id_produk, 'id_umkm' => $s->id_umkm]) }}"
                                                    class="p-2 bg-yellow-100 text-yellow-600 rounded-full hover:bg-yellow-200 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                </a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

        <!-- Pop Up Tambah Data -->
        <div id="addProductModal"
            class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-bold mb-4">Tambah Data Produk</h2>
                <form method="post" action="{{ route('umkm.simpan.produk', $id_umkm) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Nama Produk</label>
                        <input type="text"
                            class="form-control w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                            name="nama_produk" placeholder="Nama Produk" />
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Harga</label>
                        <input type="text"
                            class="form-control w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                            name="harga" placeholder="Harga" />
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Stok</label>
                        <input type="text"
                            class="form-control w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                            name="stok" placeholder="Stok" />
                    </div>
                    <div class="mb-4">
                        <label for="formFile" class="form-label">Foto Produk</label>
                        <input
                            class="form-control w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                            type="file" accept=".png, .jpg, .jpeg" name="foto_produk" id="formFile">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeAddProductModal()"
                            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Open Add Product Modal
            function openAddProductModal() {
                document.getElementById('addProductModal').classList.remove('hidden');
            }

            // Close Add Product Modal
            function closeAddProductModal() {
                document.getElementById('addProductModal').classList.add('hidden');
            }
        </script>

    </body>

    </html>
@endsection

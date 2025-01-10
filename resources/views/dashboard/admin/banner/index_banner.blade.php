@extends('dashboard.admin.layout_admin.menu')
@section('sidebar_admin')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Data Banner</title>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .sidebar {
                z-index: 50;
            }
        </style>
    </head>

    <body class="bg-gray-100">
        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <main class="p-5 md:p-10 space-y-8">
                <div class="container mx-auto p-6">
                    <!-- Header dengan Tombol Tambah -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Data Banner</h2>
                        <a href="{{ route('admin.tambah.banner') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Tambah Banner
                        </a>
                    </div>

                    <!-- Tabel Data -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama Banner</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($banner as $index => $banner)
                                    <tr class="hover:bg-gray-100 transition duration-300">
                                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $banner->nama_banner }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('admin.update.status') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_banner" value="{{ $banner->id_banner }}">
                                                <input type="hidden" name="status"
                                                    value="{{ $banner->status == 'on' ? 'off' : 'on' }}">

                                                <label class="inline-flex relative items-center cursor-pointer">
                                                    <input type="checkbox" class="sr-only peer"
                                                        onchange="this.form.submit()"
                                                        {{ $banner->status == 'on' ? 'checked' : '' }} />
                                                    <div
                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full 
                                                                peer peer-checked:bg-green-500 peer-checked:after:translate-x-full peer-checked:after:border-white
                                                                after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300
                                                                after:border after:rounded-full after:h-5 after:w-5 after:transition-all">
                                                    </div>
                                                </label>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 text-center space-x-2">
                                            <form action="{{ route('admin.banner.delete', $banner->id_banner) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?');">
                                                @csrf
                                                @method('DELETE') <!-- Menggunakan DELETE method -->
                                                <button type="submit"
                                                    class="p-2 bg-red-100 text-red-600 rounded-full hover:bg-red-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </body>

    </html>
@endsection

@extends('dashboard.admin.layout_admin.menu')
@section('sidebar_admin')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Responsive Sidebar</title>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    </head>

    <body class="bg-gray-100">

        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
            type="button"
            class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>

        <!-- Main Content -->
        <div class="flex-1 ml-0 lg:ml-64">
            <main class="p-5 md:p-10 space-y-8">
                <div class="container mx-auto p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data UMKM</h2>

                    <!-- Responsif Table -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama UMKM</th>
                                    <th scope="col" class="px-6 py-3">Nama Pemilik</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($umkm as $s)
                                    <tr class="hover:bg-gray-100 transition duration-300">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $s->nama_umkm }}
                                        </td>
                                        <td class="px-6 py-4">{{ $s->nama_lengkap }}</td>
                                        <td class="px-6 py-4">{{ $s->email }}</td>
                                        <td class="px-6 py-4 text-center space-x-2">
                                            <!-- Tombol View -->
                                            <a href="{{ route('admin.detail.umkm', $s->id_umkm) }}"
                                                class="inline-flex items-center p-2 bg-yellow-100 text-yellow-600 rounded-full hover:bg-yellow-200 transition-transform transform hover:scale-105 duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.963.5C20.423 16.49 16.64 19.5 12 19.5S3.577 16.49 2.037 12.5a1.012 1.012 0 0 1 0-.639C3.577 7.51 7.36 4.5 12 4.5s8.423 3.01 9.963 7.178a1.012 1.012 0 0 1 0 .639Z" />
                                                </svg>
                                            </a>

                                            <!-- Tombol Delete -->
                                            <form method="POST" action="{{ route('umkm.delete', $s->id_umkm) }}" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center p-2 bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition-transform transform hover:scale-105 duration-200"
                                                    onclick="return confirm('Apakah Anda Yakin Menghapus Data?');">
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
    </body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    </html>

@extends('dashboard.admin.layout_admin.menu')
@section('sidebar_admin')
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
        <!-- Sidebar Toggle Button -->
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
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        Tambah Data Banner
                    </h2>

                    <!-- Form for Adding Banner -->
                    <form action="{{ route('admin.simpan.banner') }}" method="POST" enctype="multipart/form-data"
                        class="bg-white p-6 rounded-lg shadow-md space-y-4">
                        @csrf
                        <div>
                            <label for="banner_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Banner</label>
                            <input type="text" id="banner_name" name="nama_banner"
                                class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Nama Banner" required />
                        </div>

                        <!-- Upload Image -->
                        <div>
                            <label for="banner_image" class="block text-sm font-medium text-gray-700 mb-1">Masukkan
                                Gambar</label>
                            <input type="file" id="banner_image" name="banner" accept=".png, .jpg, .jpeg"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                required />
                        </div>


                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.index.banner') }}"
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

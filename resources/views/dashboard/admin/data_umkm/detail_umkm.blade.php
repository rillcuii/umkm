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

        <div class="flex-1 ml-0 lg:ml-64">
            <main class="p-5 md:p-10 space-y-8">
                <div class="container mx-auto p-6">
                    <h1 class="text-2xl font-bold mb-6">Detail Data</h1>

                    <!-- Detail Data -->
                    <div class="bg-white shadow-lg rounded-lg p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Foto dan Data Pemilik -->
                            <div class="flex flex-col items-center lg:items-start">
                                <!-- Foto -->
                                <img id="field-image" src="{{ asset('storage/foto_profil/' . $umkm->foto_profil) }}"
                                    alt="Owner Image" class="w-32 h-32 object-cover rounded-full shadow-lg mb-4" />
                                <!-- Data Pemilik -->
                                <div class="text-center lg:text-left">
                                    <h2 class="text-lg font-bold text-gray-700">Email</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">{{ old('email', $umkm->email) }}</p>

                                    <h2 class="text-lg font-bold text-gray-700">Username</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">{{ old('username', $umkm->username) }}
                                    </p>

                                    <h2 class="text-lg font-bold text-gray-700">Nomor Handphone</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ old('nomer_handphone', $umkm->nomer_handphone) }}</p>
                                </div>
                            </div>

                            <!-- Data UMKM -->
                            <div class="col-span-2">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Nama Lengkap</h2>
                                        <p class="text-gray-600" id="field-fullname">
                                        <p class="text-gray-600 mb-4" id="field-email">
                                            {{ old('nama_lengkap', $umkm->nama_lengkap) }}</p>
                                        </p>
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Jenis Kelamin</h2>
                                        <p class="text-gray-600 mb-4" id="field-email">
                                            {{ old('jenis_kelamin', $umkm->jenis_kelamin) }}</p>
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Usia</h2>
                                        <p class="text-gray-600 mb-4" id="field-email">{{ old('usia', $umkm->usia) }}</p>
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Status Kepemilikan</h2>
                                        <p class="text-gray-600 mb-4" id="field-email">
                                            {{ old('status_kepemilikan', $umkm->status_kepemilikan) }}</p>
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Alamat Pemilik</h2>
                                        <p class="text-gray-600 mb-4" id="field-email">
                                            {{ old('alamat_pemilik', $umkm->alamat_pemilik) }}</p>
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Provinsi</h2>
                                        <p class="text-gray-600 mb-4" id="field-email">
                                            {{ old('provinsi', $umkm->provinsi_name) }}</p>
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Kabupaten/Kota</h2>
                                        <p class="text-gray-600 mb-4" id="field-email">
                                            {{ $umkm->kabupaten_kota_name }}</p>
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Kecamatan</h2>
                                        <p class="text-gray-600 mb-4" id="field-email">
                                            {{ $umkm->kecamatan_name }}</p>
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Kelurahan</h2>
                                        <p class="text-gray-600 mb-4" id="field-email">
                                            {{ $umkm->kelurahan_name }}</p>
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Kode Pos</h2>
                                        <p class="text-gray-600 mb-4" id="field-email">
                                            {{ old('kode_pos', $umkm->kode_pos) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Back Button -->
                        <div class="mt-8">
                            <a href="{{ route('admin.index.umkm') }}"
                                class="inline-block px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                Back to Table
                            </a>
                        </div>
                    </div>

                </div>
            </main>
        </div>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    </html>

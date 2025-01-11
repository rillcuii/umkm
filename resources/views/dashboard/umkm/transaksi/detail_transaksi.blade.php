@extends('dashboard.umkm.layout_umkm.menu')
@section('sidebar_umkm')
    <div class="flex-1 ml-0 lg:ml-64">
        <main class="p-5 md:p-10 space-y-8">
            <div class="container mx-auto p-6">
                <h1 class="text-2xl font-bold mb-6">Detail Data</h1>

                <!-- Detail Data -->
                <div class="bg-white shadow-lg rounded-lg p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Nama Lengkap</h2>
                                    <p class="text-gray-600" id="field-fullname">
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ old('nama_lengkap', $transaksi->nama_lengkap) }}</p>
                                    </p>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Nomor Telepon</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ old('nomor_telepon', $transaksi->nomor_telepon) }}</p>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Email</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">{{ old('Email', $transaksi->email) }}</p>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Jumlah</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ old('jumlah', $transaksi->jumlah) }}</p>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Alamat</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ old('alamat', $transaksi->alamat) }}</p>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Provinsi</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ old('provinsi', $transaksi->provinsi_name) }}</p>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Kabupaten/Kota</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ $transaksi->kabupaten_kota_name }}</p>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Kecamatan</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ $transaksi->kecamatan_name }}</p>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Kelurahan</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ $transaksi->kelurahan_name }}</p>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-700">Status</h2>
                                    <p class="text-gray-600 mb-4" id="field-email">
                                        {{ old('status', $transaksi->status) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-8">
                        <a href="{{ route('umkm.index.transaksi', ['id_umkm' => $id_umkm]) }}"
                            class="inline-block px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                            Back to Table
                        </a>
                    </div>
                </div>

            </div>
        </main>
    </div>
@endsection

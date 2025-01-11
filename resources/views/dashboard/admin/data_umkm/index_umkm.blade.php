@extends('dashboard.admin.layout_admin.menu')
@section('sidebar_admin')
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
    @endsection

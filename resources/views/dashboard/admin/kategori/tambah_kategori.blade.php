@extends('dashboard.admin.layout_admin.menu')
@section('sidebar_admin')
    <div class="flex-1 ml-0 lg:ml-64">
        <main class="p-5 md:p-10 space-y-8">
            <div class="container mx-auto p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Tambah Data Banner
                </h2>
                <form action="{{ route('admin.simpan.kategori') }}" method="POST" enctype="multipart/form-data"
                    class="bg-white p-6 rounded-lg shadow-md space-y-4">
                    @csrf
                    <div>
                        <label for="banner_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                            Kategori</label>
                        <input type="text" id="banner_name" name="nama_kategori"
                            class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nama Banner" required />
                    </div>
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.index.kategori') }}"
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
@endsection

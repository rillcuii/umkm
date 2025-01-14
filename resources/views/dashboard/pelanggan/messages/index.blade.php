@extends('navbar')
@section('navbar')
    <main class="flex flex-col min-h-screen">
        <!-- Breadcrumb -->
        <div class="flex p-6 font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <!-- Home Breadcrumb -->
                <li class="inline-flex items-center">
                    <a href="{{ route('index') }}"
                        class="inline-flex items-center font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 1 1 1-1h2a1 1 0 1 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        <span>Home</span>
                    </a>
                </li>
                <!-- Separator -->
                <li>
                    <div class="flex items-center">
                        <svg class="w-3.5 h-3.5 text-gray-400 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-900 hover:text-gray-700">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                            <span>Chat</span>
                        </a>
                    </div>
                </li>
            </ol>
        </div>

        <!-- Header Title -->


        <!-- Content -->
        <div class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-48 py-8 pb-28">
            <div class="text-lg font-bold mb-6 px-6">
                Daftar Chat
            </div>
            <div class="bg-white rounded-xl border hover:bg-gray-50">
                <ul class="divide-y divide-gray-200">
                    @if ($messages->isEmpty())
                        <li class="p-6 text-gray-500 text-center">
                            Anda belum memiliki percakapan dengan UMKM.
                        </li>
                    @else
                        @foreach ($umkms as $umkm)
                            <li class="">
                                <a href="{{ route('pelanggan.messages.show', ['id_user' => $id_user, 'id_umkm' => $umkm->id_umkm]) }}"
                                    class="flex items-center p-6 space-x-4">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/foto_umkm/' . $umkm->foto_umkm) }}"
                                            alt="{{ $umkm->nama_umkm }}" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="flex-grow">
                                        <div class="text-sm font-semibold text-gray-600">
                                            {{ $umkm->nama_umkm }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                        </div>
                                    </div>
                                    <span class="text-sm font-semibold text-green-500">
                                        Lihat
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </main>
    @include('footer')
@endsection

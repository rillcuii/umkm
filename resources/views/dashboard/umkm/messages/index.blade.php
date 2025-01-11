@extends('dashboard.umkm.layout_umkm.menu')

@section('sidebar_umkm')
    <!-- Main Content -->
    <main class="p-4 sm:ml-64">
        <div class="flex flex-col space-y-4">
            <!-- Header -->
            <div class="p-4 text-lg font-bold bg-white rounded-lg shadow">
                Daftar Pesan
            </div>

            <!-- Daftar Chat -->
            <div class="bg-white rounded-lg shadow">
                <ul class="divide-y divide-gray-200">
                    @if ($uniqueMessages->isEmpty())
                        <li class="p-6 text-gray-500">Tidak ada pesan untuk ditampilkan.</li>
                    @else
                        @foreach ($uniqueMessages as $message)
                            @php
                                // Ambil nama pengirim
                                $fromName = $userNames[$message->from_user_id] ?? 'Unknown User';

                                // Pastikan hanya pesan dari pengguna yang tampil
                                if ($message->from_user_id) {
                                    $showLink = route('umkm.messages.show', [
                                        'id_umkm' => $id_umkm,
                                        'id_user' => $message->from_user_id,
                                    ]);
                                } else {
                                    $showLink = null;
                                }
                            @endphp

                            <li class="hover:bg-gray-100">
                                <div class="flex items-center p-6">
                                    <div class="ml-4">
                                        <h3 class="text-sm font-semibold">
                                            {{-- Nama Pengirim --}}
                                            {{ $fromName }}
                                        </h3>
                                        <p class="text-xs text-gray-500">
                                            {{-- Waktu Pesan --}}
                                            {{ $message->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    {{-- Link ke percakapan --}}
                                    @if ($showLink)
                                        <a href="{{ $showLink }}" class="ml-auto text-xs text-gray-500">Lihat Pesan</a>
                                    @else
                                        <span class="ml-auto text-xs text-gray-500">Pesan tidak tersedia</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </main>
@endsection

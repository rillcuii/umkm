
    <main class="p-4 sm:ml-64">
        <div class="flex flex-col space-y-4">
            <div class="p-4 text-lg font-bold bg-white rounded-lg shadow">
                Daftar Percakapan dengan UMKM
            </div>

            <div class="bg-white rounded-lg shadow">
                <ul class="divide-y divide-gray-200">
                    @if ($messages->isEmpty())
                        <li class="p-6 text-gray-500">Anda belum memiliki percakapan dengan UMKM.</li>
                    @else
                        @foreach ($umkms as $umkm)
                            @php
                                // Ambil percakapan terakhir dengan UMKM ini
                                $message = $messages->firstWhere(function ($msg) use ($umkm, $id_user) {
                                    return ($msg->from_umkm_id == $umkm->id_umkm && $msg->from_user_id == $id_user) ||
                                        ($msg->to_umkm_id == $umkm->id_umkm && $msg->to_user_id == $id_user);
                                });
                            @endphp

                            <li class="hover:bg-gray-100">
                                <a href="{{ route('pelanggan.messages.show', ['id_user' => $id_user, 'id_umkm' => $umkm->id_umkm]) }}"
                                    class="flex items-center p-6">
                                    <div class="ml-4">
                                        <h3 class="text-sm font-semibold">{{ $umkm->nama_umkm }}</h3>
                                        {{-- <p class="text-xs text-gray-500">
                                            @if ($message)
                                                <strong>Pesan terakhir:</strong> {{ \Str::limit($message->message, 50) }}
                                            @else
                                                <strong>Pesan terakhir:</strong> Tidak ada pesan.
                                            @endif
                                        </p> --}}
                                    </div>
                                    <span class="ml-auto text-xs text-gray-500">Lihat Percakapan</span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </main>

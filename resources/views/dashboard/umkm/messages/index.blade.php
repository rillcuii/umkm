<div>
    <h2>Daftar Pesan</h2>
    @if ($messages->isEmpty())
        <p>Tidak ada pesan untuk ditampilkan.</p>
    @else
        <ul>
            @foreach ($messages as $message)
                @php
                    // Tentukan nama pengirim berdasarkan data yang tersedia
                    $fromName = $userNames[$message->from_user_id] ?? 'Unknown User';
                    $toName = $userNames[$message->to_user_id] ?? 'Unknown User';

                    // Cek apakah nilai id_umkm dan from_user_id tidak null
                    $showLink =
                        $message->from_user_id && $user->id_umkm
                            ? route('umkm.messages.show', [
                                'id_umkm' => $user->id_umkm,
                                'id_user' => $message->from_user_id,
                            ])
                            : null;
                @endphp

                <!-- Menampilkan nama pengirim dan penerima -->
                <li>
                    <strong>
                        {{-- Menampilkan nama pengirim (UMKM atau User) --}}
                        {{ $message->from_umkm_id == $id_umkm ? $message->umkm_name : $fromName }}
                    </strong>
                    -
                    <strong>
                        {{-- Menampilkan nama penerima (UMKM atau User) --}}
                        {{ $message->to_umkm_id == $id_umkm ? $message->umkm_name : $toName }}
                    </strong>
                    <br>
                    <span>{{ $message->created_at->format('d/m/Y H:i') }}</span>

                    <!-- Tampilkan link "Lihat Pesan" hanya jika nilai link valid -->
                    @if ($showLink)
                        <a href="{{ $showLink }}">Lihat Pesan</a>
                    @else
                        <span>Tautan tidak tersedia</span>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>

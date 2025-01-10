<div>
    <h2>Percakapan dengan {{ $messages->first()->user_name ?? 'Unknown User' }}</h2>

    @if ($messages->isEmpty())
        <p>Tidak ada pesan dalam percakapan ini.</p>
    @else
        <ul>
            @foreach ($messages as $message)
                <li>
                    @php
                        // Tentukan nama pengirim atau penerima
                        $senderName = '';
                        if ($message->from_umkm_id == $id_umkm) {
                            $senderName = $message->umkm_name ?: 'Unknown UMKM';
                        } else {
                            $senderName = $message->user_name ?: 'Unknown User';
                        }
                    @endphp
                    <strong>{{ $senderName }}:</strong>
                    <p>{{ $message->message }}</p>
                    <span>{{ $message->created_at->format('d/m/Y H:i') }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Form untuk mengirim pesan --}}
    <form action="{{ route('umkm.messages.send', ['id_umkm' => $id_umkm, 'id_user' => $id_user]) }}" method="POST">
        @csrf
        <textarea name="message" rows="4" required></textarea>
        <button type="submit">Kirim Pesan</button>
    </form>
</div>

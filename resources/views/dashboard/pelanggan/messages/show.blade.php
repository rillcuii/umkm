<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Percakapan dengan UMKM</title>
</head>

<body>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Percakapan dengan {{ $nama_umkm }}</h1>

        <div class="chat-box mb-4">
            @foreach ($messages as $message)
                <div class="message">
                    @if ($message->from_user_id == $id_user)
                        <div class="message-user text-right">
                            <strong>{{ $message->user_name ?? 'Pelanggan' }}:</strong>
                            <p>{{ $message->message }}</p>
                        </div>
                    @else
                        <div class="message-umkm text-left">
                            <strong>{{ $message->umkm_name ?? 'UMKM' }}:</strong>
                            <p>{{ $message->message }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <form action="{{ route('pelanggan.messages.send', ['id_user' => $id_user, 'id_umkm' => $id_umkm]) }}"
            method="POST">
            @csrf
            <div class="form-group">
                <label for="message" class="block text-lg">Kirim Pesan:</label>
                <textarea name="message" id="message" rows="4" class="w-full p-2 border rounded" required></textarea>
            </div>

            <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Kirim Pesan</button>
        </form>
    </div>
</body>

</html>

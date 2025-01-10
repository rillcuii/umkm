    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Chat dengan Pemilik UMKM</h2>

        <div class="bg-white p-6 rounded-lg shadow-md space-y-4">
            @foreach ($messages as $message)
                <div class="flex {{ $message->from_user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                    <div class="bg-gray-200 p-4 rounded-lg max-w-xs">
                        <p>{{ $message->message }}</p>
                        <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('messages.send', ['id_umkm' => $id_umkm, 'id_user' => $id_user]) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="message" rows="3" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Tulis pesan..." required></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kirim Pesan</button>
        </form>
    </div>

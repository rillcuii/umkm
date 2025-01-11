@extends('dashboard.umkm.layout_umkm.menu')

@section('sidebar_umkm')

    <main class="sm:ml-64 flex flex-col h-screen">
        <!-- Header Chat -->
        <header class="flex items-center justify-between p-4 bg-white shadow">
            <a href="{{ route('umkm.messages.index', ['id_umkm' => auth()->user()->id_umkm]) }}"
                class="text-blue-500 hover:underline">← Back</a>
            <h1 class="text-lg font-semibold">
                Percakapan dengan {{ $messages->first()->user_name ?? 'Unknown User' }}
            </h1>
        </header>

        <!-- Chat Area -->
        <div class="flex-1 p-4 overflow-y-auto bg-gray-100" id="chat-area">
            @if ($messages->isEmpty())
                <p class="text-center text-gray-500">Tidak ada pesan dalam percakapan ini.</p>
            @else
                @foreach ($messages as $message)
                    @php
                        // Menentukan apakah pesan ini dari UMKM atau dari User
                        $isFromUmkm = $message->from_umkm_id == $id_umkm;
                    @endphp

                    @if ($isFromUmkm)
                        <!-- Chat Bubble Right (Pesan dari UMKM) -->
                        <div class="flex justify-end mb-4">
                            <div class="bg-blue-500 text-white p-3 rounded-lg max-w-xs">
                                <p class="text-sm">{{ $message->message }}</p>
                                <span
                                    class="block text-xs text-gray-200">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    @else
                        <!-- Chat Bubble Left (Pesan dari User) -->
                        <div class="flex justify-start mb-4">
                            <div class="bg-gray-300 text-black p-3 rounded-lg max-w-xs">
                                <p class="text-sm">{{ $message->message }}</p>
                                <span
                                    class="block text-xs text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <!-- Input Area -->
        <footer class="p-4 bg-white shadow">
            <form action="{{ route('umkm.messages.send', ['id_umkm' => $id_umkm, 'id_user' => $id_user]) }}" method="POST"
                class="flex items-center space-x-2">
                @csrf
                <input type="text" name="message" placeholder="Type your message..." required
                    class="flex-1 p-2 border rounded-lg" />
                <button type="submit" class="p-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                    Send
                </button>
            </form>
        </footer>
    </main>

    <script>
        // Otomatis scroll ke bawah saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const chatArea = document.getElementById('chat-area');
            chatArea.scrollTop = chatArea.scrollHeight;
        });
    </script>

@endsection

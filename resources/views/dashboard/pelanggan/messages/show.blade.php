<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Percakapan dengan UMKM</title>
    <style>
        /* Tambahan untuk penyesuaian styling */
        body {
            font-family: Arial, sans-serif;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <main class="flex flex-col h-screen bg-gray-50">
        <!-- Header Chat -->
        <header class="flex-none p-4 bg-white shadow-md">
            <div class="flex items-center justify-between">
                <a href="{{ route('pelanggan.messages.index', ['id_user' => Auth::user()->id_user]) }}"
                    class="text-blue-500 hover:underline flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>
                <h1 class="text-lg font-semibold text-gray-700">
                    Percakapan dengan {{ $nama_umkm }}
                </h1>
            </div>
        </header>

        <!-- Chat Area -->
        <div class="flex-1 p-4 overflow-y-auto bg-gray-100" id="chat-area" style="scroll-behavior: smooth">
            @forelse ($messages as $message)
                @if ($message->from_user_id == $id_user)
                    <!-- Chat Bubble Right (Pesan dari User) -->
                    <div class="flex justify-end mb-4">
                        <div class="bg-blue-500 text-white p-3 rounded-2xl shadow-md max-w-xs lg:max-w-md">
                            <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                            <span class="block text-xs text-gray-200 mt-1">{{ $message->created_at->format('H:i:s') }}</span>
                        </div>
                    </div>
                @else
                    <!-- Chat Bubble Left (Pesan dari UMKM) -->
                    <div class="flex justify-start mb-4">
                        <div class="bg-gray-300 text-black p-3 rounded-2xl shadow-md max-w-xs lg:max-w-md">
                            <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                            <span class="block text-xs text-gray-500 mt-1">{{ $message->created_at->format('H:i:s') }}</span>
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-center text-gray-500">Tidak ada pesan dalam percakapan ini.</p>
            @endforelse
        </div>

        <!-- Input Area -->
        <footer class="flex-none p-4 bg-white shadow-md">
            <form action="{{ route('pelanggan.messages.send', ['id_user' => $id_user, 'id_umkm' => $id_umkm]) }}"
                method="POST" class="flex items-center space-x-4">
                @csrf
                <div class="relative flex-1">
                    <input type="text" name="message" placeholder="Ketik pesan Anda..." required
                        class="w-full p-3 bg-gray-100 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white" />
                </div>
                <button type="submit"
                    class="p-3 bg-blue-500 text-white rounded-2xl hover:bg-blue-600 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </button>
            </form>
        </footer>
    </main>

    <script>
        // Otomatis scroll ke bawah saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
            const chatArea = document.getElementById("chat-area");
            chatArea.scrollTop = chatArea.scrollHeight;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>

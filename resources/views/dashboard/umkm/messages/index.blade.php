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
                    @if ($messages->isEmpty())
                        <li class="p-6 text-gray-500">Tidak ada pesan untuk ditampilkan.</li>
                    @else
                        @foreach ($messages as $message)
                            @php
                                $fromName = $userNames[$message->from_user_id] ?? 'Unknown User';
                                $toName = $userNames[$message->to_user_id] ?? 'Unknown User';

                                $showLink =
                                    $message->from_user_id && $user->id_umkm
                                        ? route('umkm.messages.show', [
                                            'id_umkm' => $user->id_umkm,
                                            'id_user' => $message->from_user_id,
                                        ])
                                        : null;
                            @endphp

                            <li class="hover:bg-gray-100">
                                @if ($showLink)
                                    <a href="{{ $showLink }}" class="flex items-center p-6">
                                    @else
                                        <div class="flex items-center p-6">
                                @endif
                                <div class="ml-4">
                                    <h3 class="text-sm font-semibold">
                                        {{ $message->from_umkm_id == $id_umkm ? $message->umkm_name : $fromName }}
                                    </h3>
                                    <p class="text-xs text-gray-500">
                                        {{ $message->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                <span class="ml-auto text-xs text-gray-500">Lihat Pesan</span>
                                @if ($showLink)
                                    </a>
                                @else
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </main>
@endsection

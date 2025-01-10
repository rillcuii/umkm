<!-- umkm/messages/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Percakapan dengan User ID: {{ $id_user }}</h1>
    <div>
        @foreach ($messages as $message)
            <p><strong>{{ $message->from_user_id == auth()->user()->id ? 'Anda' : 'User' }}:</strong>
                {{ $message->message }}</p>
        @endforeach
    </div>

    <form action="{{ route('umkm.messages.send', ['id_umkm' => $id_umkm, 'id_user' => $id_user]) }}" method="POST">
        @csrf
        <textarea name="message" required></textarea>
        <button type="submit">Kirim Pesan</button>
    </form>
@endsection

<!-- umkm/messages/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Daftar Percakapan</h1>
    <ul>
        @foreach ($messages as $message)
            <li>
                <a href="{{ route('umkm.messages.show', ['id_umkm' => $id_umkm, 'id_user' => $message->to_user_id]) }}">
                    Percakapan dengan User ID: {{ $message->to_user_id }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
